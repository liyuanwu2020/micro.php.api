<?php


class AssociationAction  extends \lib\yaf\TplAction {

    const DISPLAY_ECHARTS = true;

    public function treeElement($name = '', $children = [], $value = '', $collapsed = false)
    {
        $response = [
            'name' => $name,
            'collapsed' => $collapsed,
        ];
        if ($children) $response['children'] = $children;
        if ($value) $response['value'] = $value;
        return $response;
    }

    public function main()
    {

        $where = [
            'ORDER' => [
                'sort' => 'ASC',
                'element' => 'ASC',
            ],
//            'LIMIT' => [0, 2],
        ];
        $height = 24;
        $list = \model\english\SplitElement::select('*', $where);
        //单词首字母(id++)->拆分(id+)->联想(id)
        $links = [];
        $letters = [];
        $nodes = [];
        $split = [];
        $splitIds = [];
        $box = [];
        $top = [];
        foreach ($list as $v) {
            $id = $v['id'] ?? 0;
            $element = $v['element'] ?? '';
            $first = $element[0] ?? '';
            $association = $v['association'] ?? '';
            $top[$first] = $first;
            $box[$first][] = $this->treeElement($element . ":" . $association, null, $id, true);
        }

        sort($top);

        foreach ($top as $first) {
            $temp = &$box[$first];
            $nodes[] = $this->treeElement($first, $temp);
        }

        $nodes = [['name' => '', 'children' => $nodes]];

        $this->assign('title', '单词联想');
        $this->assign('letters', json_encode($letters, JSON_UNESCAPED_UNICODE), false);
        $this->assign('nodes', json_encode($nodes, JSON_UNESCAPED_UNICODE), false);
        $this->assign('links', json_encode($links), false);
    }

    public function graphTest()
    {
        foreach ($list as $v) {
            $id = $v['id'] ?? 0;
            $element = $v['element'] ?? '';
            $association = $v['association'] ?? '';
            $first = $element[0] ?? '';
            $letters[$first] = $first;
            $split[$element] = $element;
            $links[] = [
                'source' => $id,
                'target' => &$splitIds[$element],
            ];
            $nodes[] = [
                'id' => $id,
                'symbol' => 'rect',//'circle', 'rect', 'roundRect', 'triangle', 'diamond', 'pin', 'arrow', 'none'
                'draggable' => true,
                'name' => $association,
                'extend' => '',
                'category' => $first,
                'label' => [
                    'show' => true,
                    'position' => 'inside',//https://www.echartsjs.com/zh/option.html#series-graph.data.label.position
                ],
                'symbolSize' => [8 * strlen($association), $height],//该类目节点标记的大小，可以设置成诸如 10 这样单一的数字，也可以用数组分开表示宽和高，例如 [20, 10] 表示标记宽为20，高为10
            ];

            var_dump(5 * strlen($association));
        }
        $letters = array_values($letters);
        sort($letters);


        $maxAssociation = max(array_column($list, 'id'));
        $maxSplit = $maxAssociation + count($split);
        $firstIds = [];
        foreach ($split as $element) {
            $first = $element[0] ?? '';
            $tempId = strval(++$maxAssociation);
            $splitIds[$element] = $tempId;
            $nodes[] = [//id:"0",name:"aaa",symbolSize:20
                'id' => $tempId,
                'symbol' => 'rect',
                'draggable' => true,
                'name' => $element,
                'extend' => '',
                'category' => $first,
                'label' => [
                    'show' => true,
                    'position' => 'inside',//https://www.echartsjs.com/zh/option.html#series-graph.data.label.position
                ],
                'symbolSize' => [8 * strlen($element), $height],//该类目节点标记的大小，可以设置成诸如 10 这样单一的数字，也可以用数组分开表示宽和高，例如 [20, 10] 表示标记宽为20，高为10
            ];
            $links[] = [
                'source' => $tempId,
                'target' => &$firstIds[$first],
                'lineStyle' => [
                    'type' => 'solid',//solid dashed dotted
                    'width' => 3,
                ],
            ];
        }

        $max = strval($maxSplit + count($letters) + 1);
        foreach ($letters as $letter) {
            $tempId = strval(++$maxSplit);
            $firstIds[$letter] = $tempId;
            $nodes[] = [//id:"0",name:"aaa",symbolSize:20
                'id' => $tempId,
                'symbol' => 'roundRect',//'image://http://xxx.xxx.xxx/a/b.png'
//                    'symbol' => 'image://' . $v->icon,//'image://http://xxx.xxx.xxx/a/b.png'
                'draggable' => true,
                'name' => $letter,
                'extend' => '',
//                'value' => $weight,
                'category' => $letter,
                'label' => [
                    'show' => true,
                    'position' => 'inside',//https://www.echartsjs.com/zh/option.html#series-graph.data.label.position
                ],
                'symbolSize' => 20,//该类目节点标记的大小，可以设置成诸如 10 这样单一的数字，也可以用数组分开表示宽和高，例如 [20, 10] 表示标记宽为20，高为10
            ];

            $links[] = [
                'source' => $tempId,
                'target' => $max,
                'lineStyle' => [
                    'type' => 'solid',//solid dashed dotted
                    'width' => 3,
                ],
            ];
        }

        $nodes[] = [//id:"0",name:"aaa",symbolSize:20
            'id' => $max,
            'symbol' => 'circle',//'image://http://xxx.xxx.xxx/a/b.png'
//                    'symbol' => 'image://' . $v->icon,//'image://http://xxx.xxx.xxx/a/b.png'
            'draggable' => true,
            'name' => '?',
            'extend' => '',
//                'value' => $weight,
            'category' => current($letters),
            'label' => [
                'show' => true,
                'position' => 'inside',//https://www.echartsjs.com/zh/option.html#series-graph.data.label.position
            ],
            'symbolSize' => 20,//该类目节点标记的大小，可以设置成诸如 10 这样单一的数字，也可以用数组分开表示宽和高，例如 [20, 10] 表示标记宽为20，高为10
        ];



        $letters = array_map(function ($v) {
            return ['name' => $v];
        }, $letters);
    }

    public function post(\entity\ApiEntity &$api)
    {
        $action = trim($this->getPost('action', ''));
        $p = intval($this->getPost('p', 0));
        $p = $p > 0 ? $p : 1;
        $keyword = trim($this->getPost('keyword', ''));
        $id = trim($this->getPost('id', ''));
        $type = trim($this->getPost('type', ''));
        $size = 20;

        switch ($action) {
            case 'delete':
                $api->data = \modules\english\English::delete($id);
                break;
            default:
                $api->data = \modules\english\English::search($type, $keyword, $p, $size);
                break;
        }

    }
}