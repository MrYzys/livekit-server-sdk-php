<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_agent_dispatch.proto

namespace Livekit;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>livekit.AgentDispatch</code>
 */
class AgentDispatch extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string id = 1;</code>
     */
    protected $id = '';
    /**
     * Generated from protobuf field <code>string agent_name = 2;</code>
     */
    protected $agent_name = '';
    /**
     * Generated from protobuf field <code>string room = 3;</code>
     */
    protected $room = '';
    /**
     * Generated from protobuf field <code>string metadata = 4;</code>
     */
    protected $metadata = '';
    /**
     * Generated from protobuf field <code>.livekit.AgentDispatchState state = 5;</code>
     */
    protected $state = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $id
     *     @type string $agent_name
     *     @type string $room
     *     @type string $metadata
     *     @type \Livekit\AgentDispatchState $state
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\LivekitAgentDispatch::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string id = 1;</code>
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Generated from protobuf field <code>string id = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setId($var)
    {
        GPBUtil::checkString($var, True);
        $this->id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string agent_name = 2;</code>
     * @return string
     */
    public function getAgentName()
    {
        return $this->agent_name;
    }

    /**
     * Generated from protobuf field <code>string agent_name = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setAgentName($var)
    {
        GPBUtil::checkString($var, True);
        $this->agent_name = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string room = 3;</code>
     * @return string
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Generated from protobuf field <code>string room = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setRoom($var)
    {
        GPBUtil::checkString($var, True);
        $this->room = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string metadata = 4;</code>
     * @return string
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * Generated from protobuf field <code>string metadata = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setMetadata($var)
    {
        GPBUtil::checkString($var, True);
        $this->metadata = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.livekit.AgentDispatchState state = 5;</code>
     * @return \Livekit\AgentDispatchState|null
     */
    public function getState()
    {
        return $this->state;
    }

    public function hasState()
    {
        return isset($this->state);
    }

    public function clearState()
    {
        unset($this->state);
    }

    /**
     * Generated from protobuf field <code>.livekit.AgentDispatchState state = 5;</code>
     * @param \Livekit\AgentDispatchState $var
     * @return $this
     */
    public function setState($var)
    {
        GPBUtil::checkMessage($var, \Livekit\AgentDispatchState::class);
        $this->state = $var;

        return $this;
    }

}

