<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('allow_url_fopen',1);

$DBVal = $_GET['DBVal'];
$step = $_GET['step'];
$fac = $_GET['fac'];

//$DBVal=`dat`;
//$step=`Oct-97`;
//$fac=100;
ob_start();

$conn = mysqli_connect('packertestcom.fatcowmysql.com', 'dbuser', 'hlove123', 'model');  
if (!$conn) { 
    die('Could not connect: ' . mysqli_error()); 
} 

$text = 'Select ' . $step .  'FROM '. $DBVal ;
//$text = 'Select `Oct-07` FROM `dat`' ;

$DDD = array();

$result = mysqli_query($conn,$text) or die(mysqli_error()); 

$count = 0;

$storeArray = array();
while ($row = mysqli_fetch_array($result)) {
    $storeArray[] =  $row[0];  
}
   
for ($z = 0; $z <= 14; $z++) {	
	$tempA= '"';
	for ($y = 0; $y <= 40; $y++) {
		for ($x = 0; $x <= 35; $x++) {
		if($storeArray[$count]>0){	
			$tempA = $tempA. (((36-$x)*50)-1000) .' '. ((($z+1) * 50) - 50) .' '. (($y * 50)-1000) .  ' '  . ($storeArray[$count] * $fac). ' ' ;
		}
		else
		{$garbage=0;}

		$count = $count +1;
		}
	}
	$tempA = $tempA.'"';
	$DDD[$z] = $tempA; 
}

//var_dump($DDD);
//http://packertest.com/Make3D_model.php

$output= "<!DOCTYPE HTML>\n" 
."<html lang=\"en\">\n" 
."	<head>\n" 
."		<title>Voxels</title>\n" 
."		<meta charset=\"utf-8\">\n" 
."		<style type=\"text/css\">\n" 
."			body {\n" 
."				font-family: Monospace;\n" 
."				font-size: 12px;\n" 
."				background-color: #f0f0f0;\n" 
."				margin: 0px;\n" 
."				overflow: hidden;\n" 
."				\n" 
."			}\n" 
."		</style>\n" 
."	</head>\n" 
."	<body>\n" 
."		<script type=\"text/javascript\" src=\"http://packertest.com/HeapVis/ThreeCanvas.js\"></script>\n" 
."		<script type=\"text/javascript\" src=\"http://packertest.com/HeapVis/ThreeCanvas.js\"></script>\n" 
."		<script type=\"text/javascript\" src=\"http://packertest.com/HeapVis/Cube.js\"></script>\n" 
."		<script type=\"text/javascript\" src=\"http://packertest.com/HeapVis/Plane.js\"></script>\n" 
."        \n"


		."<script type=\"text/javascript\">

			var container, interval,
			camera, scene, renderer,
			projector, plane, cube, linesMaterial,
			color = 0, colors = [ 0x0033CC, 0x0099CC, 0x339999, 0x33CC66, 0x00CC33, 0x00CC00, 0x00FF33, 0x00FF66, 0x33FF66, 0x66FF66, 0x99FF00, 0x99FF66, 0xCCFF00, 0xFFFF00, 0xFFCC00, 0xCCCC00, 0xFF9900, 0xCC6600, 0xFF3300, 0xCC0000, 0xFF0000,0x000000 ],
			ray, brush, objectHovered,
			mouse3D, isMouseDown = false, onMouseDownPosition,
			radious = 2500, theta = 15, onMouseDownTheta = 45, phi = 145, onMouseDownPhi = 60,
			isShiftDown = false;

			init();
			render();
            
			makeHeap();
			
			function init() {

				container = document.createElement( 'div' );
				document.body.appendChild( container );

				var info = document.createElement( 'div' );
				info.style.position = 'absolute';
				info.style.top = '5px';
				info.style.width = '100%';
				info.style.textAlign = 'center';
				info.innerHTML = \"<span style='color: #444; background-color: #fff; border-bottom: 1px solid #ddd; padding: 8px 10px; text-transform: uppercase;'> <strong>MouseWheel</strong>: Zoom, <strong>Drag</strong>: rotate | <a href='javascript:save();'>save</a> </span>\";

				container.appendChild( info );
 
				camera = new THREE.Camera( 50, window.innerWidth / window.innerHeight, 1, 10000 );
				camera.position.x = radious * Math.sin( theta * Math.PI / 360 ) * Math.cos( phi * Math.PI / 360 );
				camera.position.y = radious * Math.sin( phi * Math.PI / 360 );
				camera.position.z = radious * Math.cos( theta * Math.PI / 360 ) * Math.cos( phi * Math.PI / 360 );
				camera.target.position.y = 200;

				scene = new THREE.Scene();

				// Grid

				var geometry = new THREE.Geometry();
				geometry.vertices.push( new THREE.Vertex( new THREE.Vector3( - 1000, 0, 0 ) ) );
				geometry.vertices.push( new THREE.Vertex( new THREE.Vector3( 1000, 0, 0 ) ) );

				linesMaterial = new THREE.LineColorMaterial( 0x000000, 0.2 );

				for ( var i = 0; i <= 20; i ++ ) {

					var line = new THREE.Line( geometry, linesMaterial );
					line.position.z = ( i * 50 ) - 500;
					scene.addObject( line );

					var line = new THREE.Line( geometry, linesMaterial );
					line.position.x = ( i * 50 ) - 500;
					line.rotation.y = 90 * Math.PI / 180;
					scene.addObject( line );

				}

				projector = new THREE.Projector();

				plane = new THREE.Mesh( new Plane( 5000, 5000 ) );
				plane.rotation.x = - 90 * Math.PI / 180;
				scene.addObject( plane );

				cube = new Cube( 50, 50, 50 );

				ray = new THREE.Ray( camera.position, null );

				brush = new THREE.Mesh( cube, new THREE.MeshColorFillMaterial( colors[ color ], 0) );//transparent brush cube
				brush.position.y = 2000;
				brush.overdraw = true;
				scene.addObject( brush );

				onMouseDownPosition = new THREE.Vector2();

				// Lights

				var ambientLight = new THREE.AmbientLight( 0x404040 );
				scene.addLight( ambientLight );

				var directionalLight = new THREE.DirectionalLight( 0xffffff );
				directionalLight.position.x = 1;
				directionalLight.position.y = 1;
				directionalLight.position.z = 0.75;
				directionalLight.position.normalize();
				scene.addLight( directionalLight );

				var directionalLight = new THREE.DirectionalLight( 0x808080 );
				directionalLight.position.x = - 1;
				directionalLight.position.y = 1;
				directionalLight.position.z = - 0.5;
				directionalLight.position.normalize();
				scene.addLight( directionalLight );

				renderer = new THREE.CanvasRenderer();
				renderer.setSize( window.innerWidth, window.innerHeight );

				container.appendChild(renderer.domElement);

				document.addEventListener( 'keydown', onDocumentKeyDown, false );
				document.addEventListener( 'keyup', onDocumentKeyUp, false );

				document.addEventListener( 'mousemove', onDocumentMouseMove, false );
				document.addEventListener( 'mousedown', onDocumentMouseDown, false );
				document.addEventListener( 'mouseup', onDocumentMouseUp, false );

				document.addEventListener( 'mousewheel', onDocumentMouseWheel, false );

				if ( window.location.hash ) {

					buildFromHash();

				}

			}

			function onDocumentKeyDown( event ) {

				switch( event.keyCode ) {

					case 49: setBrushColor( 0 ); break;
					case 50: setBrushColor( 1 ); break;
					case 51: setBrushColor( 2 ); break;
					case 52: setBrushColor( 3 ); break;
					case 53: setBrushColor( 4 ); break;
					case 54: setBrushColor( 5 ); break;
					case 55: setBrushColor( 6 ); break;
					case 56: setBrushColor( 7 ); break;
					case 57: setBrushColor( 8 ); break;
					case 48: setBrushColor( 9 ); break;

					case 16: isShiftDown = true; interact(); render(); break;

					case 37: offsetScene( - 1, 0 ); break;
					case 38: offsetScene( 0, - 1 ); break;
					case 39: offsetScene( 1, 0 ); break;
					case 40: offsetScene( 0, 1 ); break;

				}

			}

			function onDocumentKeyUp( event ) {

				switch( event.keyCode ) {

					case 16: isShiftDown = false; interact(); render(); break;

				}

			}

			function onDocumentMouseDown( event ) {

				event.preventDefault();

				isMouseDown = true;

				onMouseDownTheta = theta;
				onMouseDownPhi = phi;
				onMouseDownPosition.x = event.clientX;
				onMouseDownPosition.y = event.clientY;
				console.log(onMouseDownPosition.x);
				console.log(onMouseDownPosition.y);
				console.log(brush.position.z);
				

			}

			function onDocumentMouseMove( event ) {

				event.preventDefault();

				if ( isMouseDown ) {

					theta = - ( ( event.clientX - onMouseDownPosition.x ) * 0.5 ) + onMouseDownTheta;
					phi = ( ( event.clientY - onMouseDownPosition.y ) * 0.5 ) + onMouseDownPhi;

					phi = Math.min( 180, Math.max( 0, phi ) );

					camera.position.x = radious * Math.sin( theta * Math.PI / 360 ) * Math.cos( phi * Math.PI / 360 );
					camera.position.y = radious * Math.sin( phi * Math.PI / 360 );
					camera.position.z = radious * Math.cos( theta * Math.PI / 360 ) * Math.cos( phi * Math.PI / 360 );
					camera.updateMatrix();

				}

				mouse3D = projector.unprojectVector( new THREE.Vector3( ( event.clientX / renderer.domElement.width ) * 2 - 1, - ( event.clientY / renderer.domElement.height ) * 2 + 1, 0.5 ), camera );
				ray.direction = mouse3D.subSelf( camera.position ).normalize();

				interact();
				render();

			}

			function onDocumentMouseUp( event ) {

				event.preventDefault();

				isMouseDown = false;

				

				if ( onMouseDownPosition.length() > 5 ) {

					return;

				}

				var intersect, intersects = ray.intersectScene( scene );

				if ( intersects.length > 0 ) {

					intersect = intersects[ 0 ].object == brush ? intersects[ 1 ] : intersects[ 0 ];

					if ( intersect ) {

						if ( isShiftDown ) {

							if ( intersect.object != plane ) {

								scene.removeObject( intersect.object );

							}

						} else {

							var position = new THREE.Vector3().add( intersect.point, intersect.object.matrixRotation.transform( intersect.face.normal.clone() ) );

							var voxel = new THREE.Mesh( cube, new THREE.MeshColorFillMaterial( colors[ color ] ) );
							voxel.position.x = Math.floor( position.x / 50 ) * 50 + 25;
							voxel.position.y = Math.floor( position.y / 50 ) * 50 + 25;
							voxel.position.z = Math.floor( position.z / 50 ) * 50 + 25;
							voxel.overdraw = true;
							scene.addObject( voxel );

						}

					}

				}

				updateHash();
				interact();
				render();

			}
		


function makeHeap(){
var lay=[];\n"
."var ley=[];\n"

."ley[0]  = " . $DDD[0] .  ";\n" 
."ley[1]  = " . $DDD[1] .  ";\n" 
."ley[2]  = " . $DDD[2] .  ";\n" 
."ley[3]  = " . $DDD[3] .  ";\n" 
."ley[4]  = " . $DDD[4] .  ";\n" 
."ley[5]  = " . $DDD[5] .  ";\n" 
."ley[6]  = " . $DDD[6] .  ";\n" 
."ley[7]  = " . $DDD[7] .  ";\n" 
."ley[8]  = " . $DDD[8] .  ";\n" 
."ley[9]  = " . $DDD[9] .  ";\n" 
."ley[10] = " . $DDD[10] . ";\n" 
."ley[11] = " . $DDD[11] . ";\n" 
."ley[12] = " . $DDD[12] . ";\n" 
."ley[13] = " . $DDD[13] . ";\n" 
."ley[14] = " . $DDD[14] . ";\n"

."var count=0;
var len=0;
var Ncolor;
var bits =[]
var elm=[];

for(p=0;p<=14;p++)
{lay[p]=[];

bits[p] = ley[p].toString().split(' ');
//console.log(bits[p].length);
elm[p] = Math.ceil((bits[p].length-1))/4;
count=0;

 for (i=0; i <= elm[p]; i++)
 {    	lay[p][i]=[];
 		
	 for (j=0; j<=3; j++)
	 {   //console.log('count:' + count);;
	     lay[p][i][j] = bits[p][count];
		 //console.log('Array Val:' + lay[p][i][j]);
		 //console.log('bit value:' + bits[p][count]);
		 count = count + 1;
	 }	 
 }  
}

for (y=0;y<=14;y++)
{  	count=1;
	len = lay[y].length;
	
	for (x=1;x<=len-1;x++)
	{
			Rx =   lay[y][count][0] ;
			Ry =   lay[y][count][1] ;
			Rz =   lay[y][count][2] ;
			Rcol = lay[y][count][3] ;
			
					
			if((Rcol<800)&&(Rcol>=400))
				{Ncolor=0;
				alpha=.5;
				}
			else if((Rcol<500)&&(Rcol>=400))
				{Ncolor=1;
				alpha=.5;
				}
			else if((Rcol<400)&&(Rcol>=300))
				{Ncolor=2;
				alpha=.5;
				}		
			else if((Rcol<300)&&(Rcol>=200))
				{Ncolor=3;
				alpha=.5;
				}	
			else if((Rcol<200)&&(Rcol>=100))
				{Ncolor=4;
				alpha=.5;
				}
			else if((Rcol<100)&&(Rcol>=90))
				{Ncolor=5;
				alpha=.5;
				}
			else if((Rcol<90)&&(Rcol>=80))
				{Ncolor=6;
				alpha=.5;
				}
			else if((Rcol<80)&&(Rcol>=70))
				{Ncolor=7;
				alpha=.5;
				}	
			else if((Rcol<70)&&(Rcol>=60))
				{Ncolor=8;
				alpha=.5;
				}	
			else if((Rcol<60)&&(Rcol>=50))
				{Ncolor=9;
				alpha=.5;
				}	
			else if((Rcol<50)&&(Rcol>=40))
				{Ncolor=10;
				alpha=.5;
				}
			else if((Rcol<40)&&(Rcol>=30))
				{Ncolor=11;
				alpha=.5;
				}	
			else if((Rcol<30)&&(Rcol>=20))
				{Ncolor=12;
				alpha=.5;
				}	
			else if((Rcol<20)&&(Rcol>=12))
				{Ncolor=13;
				alpha=.5;
				}	
			else if((Rcol<12)&&(Rcol>=8))
				{Ncolor=14;
				alpha=.5;
				}	
			else if((Rcol<8)&&(Rcol>=5))
				{Ncolor=15;
				alpha=.5;
				}	
			else if((Rcol<5)&&(Rcol>=1))
				{Ncolor=16;
				alpha=.5;
				}	
			else if((Rcol<1)&&(Rcol>=0.5))
				{Ncolor=17;
				alpha=.5;
				}	
			else if((Rcol<0.5)&&(Rcol>=0.1))
				{Ncolor=18;
				alpha=.5;
				}	
			else if((Rcol==0))
				{Ncolor=20;
				alpha=.5;
				}		
			else
				{Ncolor=19;
				alpha=.1;		
			}
			
			color=Ncolor;
		var voxel = new THREE.Mesh( cube, new THREE.MeshColorFillMaterial( colors[ color ],alpha ) );
							voxel.position.x = Math.floor( Rx / 50 ) * 50 + 25;
							voxel.position.y = Math.floor( Ry / 50 ) * 50 + 25;
							voxel.position.z = Math.floor( Rz / 50 ) * 50 + 25;
							voxel.overdraw = true;
							scene.addObject( voxel );
							
	
	
	count++;	
	}
	
}




var lay1 = (4*50)-50;
var row1 = ((42-20)*50)-1000;
var col1 = (22*50)-1000;

console.log(lay1);
console.log(row1);
console.log(col1);

var voxel = new THREE.Mesh( cube, new THREE.MeshColorFillMaterial( colors[ 21 ],1 ) );
							voxel.position.x = Math.floor( col1 / 50 ) * 50 + 25;
							voxel.position.y = Math.floor( lay1 / 50 ) * 50 + 25;
							voxel.position.z = Math.floor( row1 / 50 ) * 50 + 25;
							voxel.overdraw = true;
							scene.addObject( voxel );
      
	    
//ChangeVoxColor(lay[4][tTemp][1],lay[4][tTemp][0],lay[4][tTemp][2]);
}
///////////////////////////////////////////////////////////////////////////////
function ChangeVoxColor(lay, row, col)
{
	var voxel = new THREE.Mesh( cube, new THREE.MeshColorFillMaterial( colors[ 21 ],1 ) );
							voxel.position.x = Math.floor( col / 50 ) * 50 + 25;
							voxel.position.y = Math.floor( lay / 50 ) * 50 + 25;
							voxel.position.z = Math.floor( row / 50 ) * 50 + 25;
							voxel.overdraw = true;
							scene.addObject( voxel );	
	}


function onDocumentMouseWheel( event ) {

				radious -= event.wheelDeltaY;

				camera.position.x = radious * Math.sin( theta * Math.PI / 360 ) * Math.cos( phi * Math.PI / 360 );
				camera.position.y = radious * Math.sin( phi * Math.PI / 360 );
				camera.position.z = radious * Math.cos( theta * Math.PI / 360 ) * Math.cos( phi * Math.PI / 360 );
				camera.updateMatrix();

				//interact();
				render();

			}

			function setBrushColor( value ) {

				color = value;
				brush.material[ 0 ].color.setHex( colors[ color ] ^ 0x4C000000 );
console.log(value);
				render();

			}
/*
			function buildFromHash() {

				var hash = window.location.hash.substr( 1 ),
				version = hash.substr( 0, 2 );

				if ( version == \"A/\" ) {

					var current = { x: 0, y: 0, z: 0, c: 0 }
					var data = decode( hash.substr( 2 ) );
					var i = 0, l = data.length;

					while ( i < l ) {

						var code = data[ i ++ ].toString( 2 );

						if ( code.charAt( 1 ) == \"1\" ) current.x += data[ i ++ ] - 32;
						if ( code.charAt( 2 ) == \"1\" ) current.y += data[ i ++ ] - 32;
						if ( code.charAt( 3 ) == \"1\" ) current.z += data[ i ++ ] - 32;
						if ( code.charAt( 4 ) == \"1\" ) current.c += data[ i ++ ] - 32;
						if ( code.charAt( 0 ) == \"1\" ) {

							var voxel = new THREE.Mesh( cube, new THREE.MeshColorFillMaterial( colors[ current.c ] ) );
							voxel.position.x = current.x * 50 + 25;
							voxel.position.y = current.y * 50 + 25;
							voxel.position.z = current.z * 50 + 25;
							voxel.overdraw = true;
							scene.addObject( voxel );

						}
					}

				} else {

					var data = decode( hash );

					for ( var i = 0; i < data.length; i += 4 ) {

						var voxel = new THREE.Mesh( cube, new THREE.MeshColorFillMaterial( colors[ data[ i + 3 ] ] ) );
						voxel.position.x = ( data[ i ] - 20 ) * 25;
						voxel.position.y = ( data[ i + 1 ] + 1 ) * 25;
						voxel.position.z = ( data[ i + 2 ] - 20 ) * 25;
						voxel.overdraw = true;
						scene.addObject( voxel );

					}

				}

				updateHash();

			}

			function updateHash() {

				var data = [],
				current = { x: 0, y: 0, z: 0, c: 0 },
				last = { x: 0, y: 0, z: 0, c: 0 },
				code;

				for ( var i in scene.objects ) {

					object = scene.objects[ i ];

					if ( object instanceof THREE.Mesh && object !== plane && object !== brush ) {

						current.x = ( object.position.x - 25 ) / 50;
						current.y = ( object.position.y - 25 ) / 50;
						current.z = ( object.position.z - 25 ) / 50;
						current.c = colors.indexOf( object.material[ 0 ].color.hex & 0xffffff );

						code = 0;

						if ( current.x != last.x ) code += 1000;
						if ( current.y != last.y ) code += 100;
						if ( current.z != last.z ) code += 10;
						if ( current.c != last.c ) code += 1;

						code += 10000;

						data.push( parseInt( code, 2 ) );

						if ( current.x != last.x ) {

							data.push( current.x - last.x + 32 );
							last.x = current.x;

						}

						if ( current.y != last.y ) {

							data.push( current.y - last.y + 32 );
							last.y = current.y;

						}

						if ( current.z != last.z ) {

							data.push( current.z - last.z + 32 );
							last.z = current.z;

						}

						if ( current.c != last.c ) {

							data.push( current.c - last.c + 32 );
							last.c = current.c;

						}

					}

				}

				data = encode( data );
				window.location.hash = \"A/\" + data;
				document.getElementById( 'link' ).href = \"http://mrdoob.com/projects/voxels/#A/\" + data;

			}
*/
			function offsetScene( x, z ) {

				var offset = new THREE.Vector3( x, 0, z ).multiplyScalar( 50 );

				for ( var i in scene.objects ) {

					object = scene.objects[ i ];

					if ( object instanceof THREE.Mesh && object !== plane && object !== brush ) {

						object.position.addSelf( offset );

					}

				}

				updateHash();
				interact();
				render();

			}

			function interact() {

				if ( objectHovered ) {

					objectHovered.material[ 0 ].color.a = 1;
					objectHovered.material[ 0 ].color.updateStyleString();
					objectHovered = null;

				}

				var position, intersect, intersects = ray.intersectScene( scene );

				if ( intersects.length > 0 ) {

					intersect = intersects[ 0 ].object != brush ? intersects[ 0 ] : intersects[ 1 ];

					if ( intersect ) {

						if ( isShiftDown ) {

							if ( intersect.object != plane ) {

								objectHovered = intersect.object;
								objectHovered.material[ 0 ].color.a = 0.5;
								objectHovered.material[ 0 ].color.updateStyleString();

								return;

							}

						} else {

							position = new THREE.Vector3().add( intersect.point, intersect.object.matrixRotation.transform( intersect.face.normal.clone() ) );

							brush.position.x = Math.floor( position.x / 50 ) * 50 + 25;
							brush.position.y = Math.floor( position.y / 50 ) * 50 + 25;
							brush.position.z = Math.floor( position.z / 50 ) * 50 + 25;

							return;

						}

					}

				}

				brush.position.y = 2000;

			}

			function render() {

				renderer.render( scene, camera );

			}

			function save() {

				linesMaterial.color.setRGBA( 0, 0, 0, 0 );
				brush.position.y = 2000;
				render();

				window.open( renderer.domElement.toDataURL('image/png'), 'mywindow' );

				linesMaterial.color.setRGBA( 0, 0, 0, 0.2 );
				render();

			}

			function clear() {

				if ( !confirm( 'Are you sure?' ) ) {

					return

				}

				window.location.hash = \"\";

				var i = 0;

				while ( i < scene.objects.length ) {

					object = scene.objects[ i ];

					if ( object instanceof THREE.Mesh && object !== plane && object !== brush ) {

						scene.removeObject( object );
						continue;
					}

					i ++;
				}

				updateHash();
				render();

			}

		</script>";

//echo $output;

unlink ('3D_out.html');
  file_put_contents('3D_out.html', $output);


?>