@extends('layouts.layout_360')

@section('title', 'V360e')

@section('content')
    <div id="photosphere"></div>


{{ Html::script('public/plugins/360/dist/three.js/three.min.js') }}
{{ Html::script('public/plugins/360/dist/D.min.js') }}
{{ Html::script('public/plugins/360/dist/uevent/uevent.min.js') }}
{{ Html::script('public/plugins/360/dist/doT/doT.min.js') }}
{{ Html::script('public/plugins/360/dist/CanvasRenderer.js') }}
{{ Html::script('public/plugins/360/dist/Projector.js') }}
{{ Html::script('public/plugins/360/dist/EffectComposer.js') }}
{{ Html::script('public/plugins/360/dist/RenderPass.js') }}
{{ Html::script('public/plugins/360/dist/ShaderPass.js') }}
{{ Html::script('public/plugins/360/dist/MaskPass.js') }}
{{ Html::script('public/plugins/360/dist/CopyShader.js') }}
{{ Html::script('public/plugins/360/dist/DeviceOrientationControls.js') }}
{{ Html::script('public/plugins/360/dist/photo-sphere-viewer.min.js') }}

<script type="text/template" id="pin-content">
<h1>V360e</h1>

<p><strong>V360e</strong> , é um aplicativo para visualização em realidade aumentada, um recurso que possibilita todos os participantes pertinente um determinado imóvel tirar todas as dúvidas em relação de como estava determinado ambiente do imóvel. <em>Aenean ultricies mi vitae est.</em> Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, <code>commodo vitae</code>, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. <a href="#">Donec non enim</a> in turpis pulvinar facilisis. Ut felis.</p>

<h2>Header Level 2</h2>

<ol>
   <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
   <li>Aliquam tincidunt mauris eu risus.</li>
</ol>

<blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.</p></blockquote>

<h3>Header Level 3</h3>

<ul>
   <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
   <li>Aliquam tincidunt mauris eu risus.</li>
</ul>

<pre><code>
#header h1 a {
  display: block;
  width: 300px;
  height: 80px;
}
</code></pre>
</script>

<svg id="patterns">
  <defs>
    <pattern id="dots" x="10" y="10" width="30" height="30" patternUnits="userSpaceOnUse">
      <circle cx="10" cy="10" r="10" style="stroke: none; fill: rgba(255,0,0,0.4)" />
    </pattern>
    <pattern id="points" x="10" y="10" width="15" height="15" patternUnits="userSpaceOnUse">
      <circle cx="10" cy="10" r="0.8" style="stroke: none; fill: red" />
    </pattern>
  </defs>
</svg>

<script>
var rootURL = domain_complet;
var nome = "{{$name}}";

  var PSV = new PhotoSphereViewer({
    panorama: rootURL+'/public/dist/img/upload/vistoria/'+nome,
    container: 'photosphere',
    loading_img: rootURL+'/public/dist/img/upload/vistoria/photosphere-logo.gif',
    navbar: [
      'autorotate', 'zoom', 'download', 'markers',
      'spacer-1',
      {
        title: 'Change image',
        className: 'custom-button',
        content: '↻',
        onClick: (function() {
          var i = false;

          return function() {
            i = !i;
            PSV.clearMarkers();

            PSV.setPanorama(i ? rootURL+'/public/dist/img/upload/vistoria/'+nome : 'SAM_100_0084.jpg', {
              longitude: i ? 3.7153696451829257 : 3.8484510006474992,
              latitude: i ? 0.57417649320975916 : -0.24434609527920628
            }, true)
              .then(function() {
                PSV.setCaption(i ? 'Vistoria 360e <b>&copy; Espindola Imobiliária</b>' : 'Vistoria 360e <b>&copy; Espindola Imobiliária</b>');
              });
          }
        }())
      },
      {
        id: 'disabled',
        title: 'This button is disabled',
        content: '❌',
        enabled: false
      },
      'caption',
      'gyroscope',
      'fullscreen'
    ],
    caption: 'Vistoria 360e <b>&copy; Espindola Imobiliária</b>',
    longitude_range: [-7*Math.PI/8, 7*Math.PI/8],
    latitude_range: [-3*Math.PI/4, 3*Math.PI/4],
    anim_speed: '-2rpm',
    default_fov: 50,
    fisheye: true,
    move_speed: 1.1,
    time_anim: false,
    gyroscope: true,
    webgl: true,
    transition: {
      duration: 1000,
      loader: true,
      blur: true
    },
    markers: (function(){
      var a = [];
      for (var i=0; i<Math.PI*2; i+=Math.PI/4) {
        for (var j=-Math.PI/2+Math.PI/4; j<Math.PI/2; j+=Math.PI/4) {
          a.push({
            id: '#' + a.length,
            tooltip: '#' + a.length,
            latitude: j,
            longitude: i,
            image: 'pin.png',
            width: 32,
            height: 32,
            anchor: 'bottom center',
            data: {
              deletable: true
            }
          });
        }
      }

      a.push({
        id: 'the-path',
        name: 'The path',
        content: '<img src="pin2.png" style="width:100%"/><img src="pin.png" style="width:100%"/>',
        x: 3900,
        y: 1650,
        image: 'pin2.png',
        width: 32,
        height: 32,
        anchor: 'bottom center'
      });

      a.push({
        id: 'lorem',
        tooltip: {
          content: 'Informações sobre o aplicativo V360e.',
          position: 'bottom right'
        },
        content: document.getElementById('pin-content').innerHTML,
        latitude: 0,
        longitude: 0.20,
        image: 'pin2.png',
        width: 32,
        height: 32,
        anchor: 'bottom center'
      });

      
      a.push({
        id: 'polygon-sky',
        svgStyle: {
          fill: 'rgba(0, 190, 255, 0.1)'
        },
        polygon_rad: (function() {
          var points = [];

          for (var i = 0; i < Math.PI*2; i+= Math.PI/8) {
            points.push(i);
            points.push(Math.PI/8);
          }

          return points;
        }())
      });

      return a;
    }())
  });



  PSV.on('select-marker', function(marker) {
    if (marker.data && marker.data.deletable) {
      PSV.removeMarker(marker);
    }
    else if (marker.id === 'gif') {
      var width = (Math.random()*0.4 + 0.8) * marker.width;
      PSV.updateMarker({
        id: marker.id,
        width: width,
        height: width
      });
    }
  });
</script>

<script>
  document.write('<script src="//' + location.host.split(':')[0] + ':35729/livereload.js" async defer><' + '/script>');
</script>
@endsection