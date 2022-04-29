@php
echo '<?xml version="1.0"?>';   
@endphp
<VAST version="2.0">
  <Ad id="static">
    <InLine>
      <AdSystem>Static VAST Template</AdSystem>
      <AdTitle>Static VAST Tag</AdTitle>
      <Error>https://www.cloud-streaming.com/tracking/pixel.gif</Error>
      <Impression>https://www.cloud-streaming.com/tracking/pixel.gif</Impression>
      <Creatives>
        <Creative sequence="1">
          <NonLinearAds>
            <NonLinear height="64" width="950" maintainAspectRatio="true" scalable="true" minSuggestedDuration="10:00:00">
              <StaticResource creativeType="image/jpeg">{{ asset($result->image_ads) }}</StaticResource>
              <NonLinearClickThrough>{{ $result->url_ads }}</NonLinearClickThrough>
            </NonLinear>
            <TrackingEvents>
              <Tracking event="creativeView">https://www.cloud-streaming.com/tracking/pixel.gif</Tracking>
              <Tracking event="expand">https://www.cloud-streaming.com/tracking/pixel.gif</Tracking>
              <Tracking event="collapse">https://www.cloud-streaming.com/tracking/pixel.gif</Tracking>
              <Tracking event="acceptInvitation">https://www.cloud-streaming.com/tracking/pixel.gif</Tracking>
              <Tracking event="close">http://2in1tv.com/images/ads/close.svg</Tracking>
            </TrackingEvents>
          </NonLinearAds>
        </Creative>
        <!--Creative sequence="1">
          <CompanionAds>
            <Companion id="1" width="300" height="250">
              <StaticResource creativeType="image/jpeg">https://s3.amazonaws.com/demo.jwplayer.com/static-tag/jwplayer-rectangle-blue.jpg</StaticResource>
              <CompanionClickThrough>https://www.jwplayer.com/</CompanionClickThrough>
            </Companion>
            <Companion id="2" width="728" height="90">
              <StaticResource creativeType="image/jpeg">https://s3.amazonaws.com/demo.jwplayer.com/static-tag/jwplayer-banner-blue.jpg</StaticResource>
              <CompanionClickThrough>https://www.jwplayer.com/</CompanionClickThrough>
            </Companion>
          </CompanionAds>
        </Creative-->
      </Creatives>
    </InLine>
  </Ad>
</VAST>
