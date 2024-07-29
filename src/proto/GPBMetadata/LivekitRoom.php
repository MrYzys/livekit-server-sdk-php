<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: livekit_room.proto

namespace GPBMetadata;

class LivekitRoom
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\LivekitModels::initOnce();
        \GPBMetadata\LivekitEgress::initOnce();
        \GPBMetadata\LivekitAgentDispatch::initOnce();
        $pool->internalAddGeneratedFile(
            '
�
livekit_room.protolivekitlivekit_egress.protolivekit_agent_dispatch.proto"�
CreateRoomRequest
name (	
config_name (	
empty_timeout (
departure_timeout
 (
max_participants (
node_id (	
metadata (	#
egress (2.livekit.RoomEgress!
agent (2.livekit.RoomAgent
min_playout_delay (
max_playout_delay (
sync_streams	 (
replay_enabled ("�

RoomEgress1
room (2#.livekit.RoomCompositeEgressRequest3
participant (2.livekit.AutoParticipantEgress(
tracks (2.livekit.AutoTrackEgress";
	RoomAgent.

dispatches (2.livekit.RoomAgentDispatch"!
ListRoomsRequest
names (	"1
ListRoomsResponse
rooms (2.livekit.Room"!
DeleteRoomRequest
room (	"
DeleteRoomResponse"\'
ListParticipantsRequest
room (	"J
ListParticipantsResponse.
participants (2.livekit.ParticipantInfo"9
RoomParticipantIdentity
room (	
identity (	"
RemoveParticipantResponse"X
MuteRoomTrackRequest
room (	
identity (	
	track_sid (	
muted (":
MuteRoomTrackResponse!
track (2.livekit.TrackInfo"�
UpdateParticipantRequest
room (	
identity (	
metadata (	2

permission (2.livekit.ParticipantPermission
name (	E

attributes (21.livekit.UpdateParticipantRequest.AttributesEntry1
AttributesEntry
key (	
value (	:8"�
UpdateSubscriptionsRequest
room (	
identity (	

track_sids (	
	subscribe (6
participant_tracks (2.livekit.ParticipantTracks"
UpdateSubscriptionsResponse"�
SendDataRequest
room (	
data (&
kind (2.livekit.DataPacket.Kind
destination_sids (	B
destination_identities (	
topic (	H �B
_topic"
SendDataResponse";
UpdateRoomMetadataRequest
room (	
metadata (	"�
RoomConfiguration
name (	
empty_timeout (
departure_timeout (
max_participants (#
egress (2.livekit.RoomEgress!
agent (2.livekit.RoomAgent
min_playout_delay (
max_playout_delay (
sync_streams	 (2�
RoomService7

CreateRoom.livekit.CreateRoomRequest.livekit.RoomB
	ListRooms.livekit.ListRoomsRequest.livekit.ListRoomsResponseE

DeleteRoom.livekit.DeleteRoomRequest.livekit.DeleteRoomResponseW
ListParticipants .livekit.ListParticipantsRequest!.livekit.ListParticipantsResponseL
GetParticipant .livekit.RoomParticipantIdentity.livekit.ParticipantInfoY
RemoveParticipant .livekit.RoomParticipantIdentity".livekit.RemoveParticipantResponseS
MutePublishedTrack.livekit.MuteRoomTrackRequest.livekit.MuteRoomTrackResponseP
UpdateParticipant!.livekit.UpdateParticipantRequest.livekit.ParticipantInfo`
UpdateSubscriptions#.livekit.UpdateSubscriptionsRequest$.livekit.UpdateSubscriptionsResponse?
SendData.livekit.SendDataRequest.livekit.SendDataResponseG
UpdateRoomMetadata".livekit.UpdateRoomMetadataRequest.livekit.RoomBFZ#github.com/livekit/protocol/livekit�LiveKit.Proto�LiveKit::Protobproto3'
        , true);

        static::$is_initialized = true;
    }
}

