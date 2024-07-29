<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_egress.proto

namespace Livekit;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>livekit.AutoTrackEgress</code>
 */
class AutoTrackEgress extends \Google\Protobuf\Internal\Message
{
    /**
     * see docs for templating (default {track_id}-{time})
     *
     * Generated from protobuf field <code>string filepath = 1;</code>
     */
    protected $filepath = '';
    /**
     * disables upload of json manifest file (default false)
     *
     * Generated from protobuf field <code>bool disable_manifest = 5;</code>
     */
    protected $disable_manifest = false;
    protected $output;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $filepath
     *           see docs for templating (default {track_id}-{time})
     *     @type bool $disable_manifest
     *           disables upload of json manifest file (default false)
     *     @type \Livekit\S3Upload $s3
     *     @type \Livekit\GCPUpload $gcp
     *     @type \Livekit\AzureBlobUpload $azure
     *     @type \Livekit\AliOSSUpload $aliOSS
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\LivekitEgress::initOnce();
        parent::__construct($data);
    }

    /**
     * see docs for templating (default {track_id}-{time})
     *
     * Generated from protobuf field <code>string filepath = 1;</code>
     * @return string
     */
    public function getFilepath()
    {
        return $this->filepath;
    }

    /**
     * see docs for templating (default {track_id}-{time})
     *
     * Generated from protobuf field <code>string filepath = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setFilepath($var)
    {
        GPBUtil::checkString($var, True);
        $this->filepath = $var;

        return $this;
    }

    /**
     * disables upload of json manifest file (default false)
     *
     * Generated from protobuf field <code>bool disable_manifest = 5;</code>
     * @return bool
     */
    public function getDisableManifest()
    {
        return $this->disable_manifest;
    }

    /**
     * disables upload of json manifest file (default false)
     *
     * Generated from protobuf field <code>bool disable_manifest = 5;</code>
     * @param bool $var
     * @return $this
     */
    public function setDisableManifest($var)
    {
        GPBUtil::checkBool($var);
        $this->disable_manifest = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.livekit.S3Upload s3 = 2;</code>
     * @return \Livekit\S3Upload|null
     */
    public function getS3()
    {
        return $this->readOneof(2);
    }

    public function hasS3()
    {
        return $this->hasOneof(2);
    }

    /**
     * Generated from protobuf field <code>.livekit.S3Upload s3 = 2;</code>
     * @param \Livekit\S3Upload $var
     * @return $this
     */
    public function setS3($var)
    {
        GPBUtil::checkMessage($var, \Livekit\S3Upload::class);
        $this->writeOneof(2, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.livekit.GCPUpload gcp = 3;</code>
     * @return \Livekit\GCPUpload|null
     */
    public function getGcp()
    {
        return $this->readOneof(3);
    }

    public function hasGcp()
    {
        return $this->hasOneof(3);
    }

    /**
     * Generated from protobuf field <code>.livekit.GCPUpload gcp = 3;</code>
     * @param \Livekit\GCPUpload $var
     * @return $this
     */
    public function setGcp($var)
    {
        GPBUtil::checkMessage($var, \Livekit\GCPUpload::class);
        $this->writeOneof(3, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.livekit.AzureBlobUpload azure = 4;</code>
     * @return \Livekit\AzureBlobUpload|null
     */
    public function getAzure()
    {
        return $this->readOneof(4);
    }

    public function hasAzure()
    {
        return $this->hasOneof(4);
    }

    /**
     * Generated from protobuf field <code>.livekit.AzureBlobUpload azure = 4;</code>
     * @param \Livekit\AzureBlobUpload $var
     * @return $this
     */
    public function setAzure($var)
    {
        GPBUtil::checkMessage($var, \Livekit\AzureBlobUpload::class);
        $this->writeOneof(4, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.livekit.AliOSSUpload aliOSS = 6;</code>
     * @return \Livekit\AliOSSUpload|null
     */
    public function getAliOSS()
    {
        return $this->readOneof(6);
    }

    public function hasAliOSS()
    {
        return $this->hasOneof(6);
    }

    /**
     * Generated from protobuf field <code>.livekit.AliOSSUpload aliOSS = 6;</code>
     * @param \Livekit\AliOSSUpload $var
     * @return $this
     */
    public function setAliOSS($var)
    {
        GPBUtil::checkMessage($var, \Livekit\AliOSSUpload::class);
        $this->writeOneof(6, $var);

        return $this;
    }

    /**
     * @return string
     */
    public function getOutput()
    {
        return $this->whichOneof("output");
    }

}

