<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: helloworld.proto

namespace GPBMetadata;

class Helloworld
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        $pool->internalAddGeneratedFile(
            '
�
helloworld.proto
helloworld"
HelloRequest
name (	"

HelloReply
message (	2�
Greeter>
SayHello.helloworld.HelloRequest.helloworld.HelloReply" K
SayHelloStreamReply.helloworld.HelloRequest.helloworld.HelloReply" 0bproto3'
        , true);

        static::$is_initialized = true;
    }
}

