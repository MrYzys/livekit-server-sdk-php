<?php

namespace Agence104\LiveKit;

use Twirp\Context;
use Livekit\EgressInfo;
use Livekit\StreamOutput;
use Livekit\EncodingOptions;
use Livekit\DirectFileOutput;
use Livekit\StopEgressRequest;
use Livekit\ListEgressRequest;
use Livekit\EncodedFileOutput;
use Livekit\ListEgressResponse;
use Livekit\TrackEgressRequest;
use Livekit\UpdateLayoutRequest;
use Livekit\UpdateStreamRequest;
use Livekit\EncodingOptionsPreset;
use Livekit\RoomCompositeEgressRequest;
use Livekit\TrackCompositeEgressRequest;

class EgressClient {

  /**
   * The Twirp RPC adapter for client implementation.
   *
   * @var \Livekit\RoomServiceClient
   */
  protected $rpc;

  /**
   * The API Key, can be set in env var LIVEKIT_API_KEY.
   *
   * @var string
   */
  protected $apiKey;

  /**
   * The API Secret, can be set in env var LIVEKIT_API_SECRET.
   *
   * @var string
   */
  protected $apiSecret;

  /**
   * RoomServiceClient Class Constructor.
   *
   * @param string $host
   *   The hostname including protocol. i.e. 'https://cluster.livekit.io'.
   * @param string|null $apiKey
   *   The API Key, can be set in env var LIVEKIT_API_KEY.
   * @param string|null $apiSecret
   *   The API Secret, can be set in env var LIVEKIT_API_SECRET.
   *
   * @throws \Exception
   */
  public function __construct(string $host, string $apiKey = NULL, string $apiSecret = NULL) {
    $apiKey = $apiKey ?? getenv('LIVEKIT_API_KEY');
    $apiSecret = $apiSecret ?? getenv('LIVEKIT_API_SECRET');

    if (!$apiKey || !$apiSecret) {
      throw new \Exception('ApiKey and apiSecret are required.');
    }

    $this->rpc = new \Livekit\EgressClient($host);
    $this->apiKey = $apiKey;
    $this->apiSecret = $apiSecret;
  }

  /**
   * Get the stream output parameters.
   *
   * @param \Livekit\EncodedFileOutput|\Livekit\StreamOutput $output
   *   The output stream.
   * @param \Livekit\EncodingOptionsPreset|\Livekit\EncodingOptions|NULL $options
   *   The output options.
   *
   * @return array
   *   The output parameters as an array.
   */
  public function getOutputParams(
    EncodedFileOutput|StreamOutput $output,
    EncodingOptionsPreset|EncodingOptions $options = NULL
  ){
    $file = NULL;
    $stream = NULL;
    $present = NULL;
    $advanced = NULL;

    if ($output instanceof EncodedFileOutput && !empty($output->getFilepath())) {
      $file = $output;
    }
    else {
      $stream = $output;
    }

    if ($options) {
      if ($options instanceof EncodingOptionsPreset) {
        $present = $options;
      }
      else {
        $advanced = $options;
      }
    }

    return [
      $file,
      $stream,
      $present,
      $advanced
    ];
  }

  /**
   * Starts a room composite egress which uses a web template.
   *
   * @param string $roomName
   *   The room name.
   * @param string $layout
   *   The egress layout.
   * @param \Livekit\EncodedFileOutput|\Livekit\StreamOutput $output
   *   The file or stream output.
   * @param \Livekit\EncodingOptionsPreset|\Livekit\EncodingOptions|NULL $options
   *   The encoding options or preset.
   * @param bool $audioOnly
   *   The flag which defines if we record only the audio or not.
   * @param bool $videoOnly
   *   The flag which defines if we record only the video or not.
   * @param string $customBaseUrl
   *   The custom template url.
   *
   * @return \Livekit\EgressInfo
   */
  public function startRoomCompositeEgress(
    string $roomName,
    string $layout,
    EncodedFileOutput|StreamOutput $output,
    EncodingOptionsPreset|EncodingOptions $options = NULL,
    bool $audioOnly = FALSE,
    bool $videoOnly = FALSE,
    string $customBaseUrl = ''
  ): EgressInfo {
    [$file, $stream, $preset, $advanced] = $this->getOutputParams($output, $options);
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomRecord();
    return $this->rpc->StartRoomCompositeEgress(
      $this->authHeader($videoGrant),
      new RoomCompositeEgressRequest([
        'room_name' => $roomName,
        'layout' => $layout,
        'audio_only' => $audioOnly,
        'video_only' => $videoOnly,
        'custom_base_url' => $customBaseUrl,
        'file' => $file,
        'stream' => $stream,
        'present' => $preset,
        'advanced' => $advanced,
      ])
    );
  }

  /**
   * Starts a track composite egress with up to one audio track and one video
   * track. Track IDs can be found using webhooks or one of the server SDKs.
   *
   * @param string $roomName
   *   The room name.
   * @param \Livekit\EncodedFileOutput|\Livekit\StreamOutput $output
   *   The file or stream output.
   * @param string $audioTrackId
   *   The audio track id.
   * @param string $videoTrackId
   *   The video track id.
   * @param \Livekit\EncodingOptionsPreset|\Livekit\EncodingOptions|NULL $options
   *   The encoding options or preset.
   *
   * @return \Livekit\EgressInfo
   */
  public function startTrackCompositeEgress(
    string $roomName,
    EncodedFileOutput|StreamOutput $output,
    string $audioTrackId = '',
    string $videoTrackId = '',
    EncodingOptionsPreset|EncodingOptions $options = NULL,
  ): EgressInfo {
    [$file, $stream, $preset, $advanced] = $this->getOutputParams($output, $options);
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomRecord();
    return $this->rpc->StartTrackCompositeEgress(
      $this->authHeader($videoGrant),
      new TrackCompositeEgressRequest([
        'room_name' => $roomName,
        'audio_track_id' => $audioTrackId,
        'video_track_id' => $videoTrackId,
        'file' => $file,
        'stream' => $stream,
        'present' => $preset,
        'advanced' => $advanced,
      ])
    );
  }

  /**
   * Starts a track egress. Track ID can be found using webhooks or one of the
   * server SDKs.
   *
   * @param string $roomName
   *   The room name.
   * @param \Livekit\DirectFileOutput|string $output
   *   The file or websocket output.
   * @param string $trackId
   *   The track id
   *
   * @return \Livekit\EgressInfo
   */
  public function startTrackEgress(
    string $roomName,
    DirectFileOutput|string $output,
    string $trackId
  ): EgressInfo {
    $file = $output instanceof DirectFileOutput
      ? $output
      : NULL;

    $webSocketUrl = !($output instanceof DirectFileOutput)
      ? (string)$output
      : NULL;

    $videoGrant = new VideoGrant();
    $videoGrant->setRoomRecord();
    return $this->rpc->StartTrackEgress(
      $this->authHeader($videoGrant),
      new TrackEgressRequest([
        'room_name' => $roomName,
        'track_id' => $trackId,
        'file' => $file,
        'websocket_url' => $webSocketUrl,
      ])
    );
  }

  /**
   * Updates the web layout of an active RoomCompositeEgress.
   *
   * @param string $egressId
   *   The egress id.
   * @param string $layout
   *   The egress layout.
   *
   * @return \Livekit\EgressInfo
   */
  public function updateLayout(
    string $egressId,
    string $layout
  ): EgressInfo {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomRecord();
    return $this->rpc->UpdateLayout(
      $this->authHeader($videoGrant),
      new UpdateLayoutRequest([
        'egress_id' => $egressId,
        'laytout' => $layout,
      ])
    );
  }

  /**
   * Adds or removes stream urls from an active stream.
   *
   * @param string $egressId
   *   The egress id.
   * @param array $addOutputUrls
   *   The output Urls to add to the active stream.
   * @param array $removeOutputUrls
   *   The output Urls to remove from the active stream.
   *
   * @return \Livekit\EgressInfo
   */
  public function updateStream(
    string $egressId,
    array $addOutputUrls = [],
    array $removeOutputUrls = []
  ): EgressInfo {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomRecord();
    return $this->rpc->UpdateStream(
      $this->authHeader($videoGrant),
      new UpdateStreamRequest([
        'egress_id' => $egressId,
        'add_output_urls' => $addOutputUrls,
        'remove_output_urls' => $removeOutputUrls,
      ])
    );
  }

  /**
   * Gets the list of active egress. Does not include completed egress.
   *
   * @param string $roomName
   *   The room name.
   *
   * @return \Livekit\ListEgressResponse
   */
  public function listEgress(string $roomName = ''): ListEgressResponse {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomRecord();
    return $this->rpc->ListEgress(
      $this->authHeader($videoGrant),
      new ListEgressRequest([
        'room_name' => $roomName,
      ])
    );
  }

  /**
   * Stops an active egress.
   *
   * @param string $egressId
   *   The egress id.
   *
   * @return \Livekit\EgressInfo
   */
  public function stopEgress(string $egressId): EgressInfo {
    $videoGrant = new VideoGrant();
    $videoGrant->setRoomRecord();
    return $this->rpc->StopEgress(
      $this->authHeader($videoGrant),
      new StopEgressRequest([
        'egress_id' => $egressId,
      ])
    );
  }

  /**
   * Fetches the authorization header to be passed in the request.
   *
   * @param \Agence104\LiveKit\VideoGrant $videoGrant
   *   The grants to apply on the AccessToken.
   *
   * @return array
   *   If everything worked, then the header values are returned,
   *   else an empty array is returned.
   */
  private function authHeader(VideoGrant $videoGrant): array {
    $tokenOptions = (new AccessTokenOptions())
      ->setTtl(10 * 60); // 10 minutes.

    try {
      $accessToken = (new AccessToken($this->apiKey, $this->apiSecret))
        ->init($tokenOptions)
        ->setGrant($videoGrant);
      return Context::withHttpRequestHeaders([], [
        "Authorization" => "Bearer " . $accessToken->toJwt(),
      ]);
    }
    catch (\Exception $e) {
      return [];
    }
  }

}
