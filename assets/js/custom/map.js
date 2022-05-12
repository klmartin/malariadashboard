
// var map ;
// var maps=[];
// var client;
// var source;
// var level;
// var legend_array;

// var vis_ids;

// var count=[0,0,0,0,0,0];




//     function drawmap(data,vis_id,levels,legend_arrays,subtitle,filter,i){



//     (function(index){

//       // console.log("The legend_array",legend_arrays);


//       count=[];
//       count=[0,0,0,0,0,0];


//       if ( maps[vis_id] != undefined)  maps[vis_id].remove();

//         document.getElementById('numb'+vis_id).innerHTML = "";

//         //map.setView([-5.665243545101811, 39.47045283836419], 8.5);

//         map = L.map('numb'+vis_id).setView([-5.665243545101811, 39.47045283836419], 8);

//         map.scrollWheelZoom.disable();

//         maps[vis_id]=map;

//         vis_ids=vis_id;

//         map.zoomControl.setPosition('topright');


//       // map.setView([-5.665243545101811, 39.47045283836419], 8.5);

//    //   const wellBounds = new L.latLngBounds([-4.8562613604186655, 39.68225183059107],[-6.516486, 39.506349]);
// 		 // map.fitBounds(wellBounds);

//         level=levels;
//         legend_array=legend_arrays


//         L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/light_all/{z}/{x}/{y}.png', {
//         maxZoom: 19,
//         zoomControl: false


//         }).addTo(map);

//         if(level>0){

//         client = new carto.Client({
//         apiKey: 'f99a497f0aef7a920d66551001a98875180421ae',
//         username: 'citsappstz'
//         });

//         var source = new carto.source.Dataset('level'+level);
//         var style = new carto.style.CartoCSS(`
//         #layer {
//             polygon-fill: #ffffff;
//             polygon-opacity: 0.9;
//           }
//           #layer::outline {
//             line-width: 1;
//             line-color: #000000;
//             line-opacity: 0.56;
//           }

//         `);

     

// 		var layer = new carto.layer.Layer(source, style);

// 		client.addLayer(layer);


// 		data.forEach(data_extract);

//     var colors= ['#ffffd4','#fed98e','#fe9929','#d95f0e','#993404'];


// 		L.CustomControl = L.Control.extend({
//       options: {
//         position: 'topright'
//         //control position - allowed: 'topleft', 'topright', 'bottomleft', 'bottomright'

//       },

//       onAdd: function (map) {

//         var container = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
//         container.title = "Plain Text Title";
//         var button = L.DomUtil.create('a', '', container);
//         button.style.display = "block";
//         button.innerHTML = '<i class="fa fa-list"></i>';
//         L.DomEvent.disableClickPropagation(button);
//         L.DomEvent.on(button, 'click', this._click,this);
//         L.DomEvent.on(button, 'mouseover', this._mouseover,this);
//         L.DomEvent.on(button, 'mouseout', this._mouseout,this);



//         var hiddenContainer = L.DomUtil.create('div', ' legend',container);
//         hiddenContainer.style.display = "none";

//         L.DomEvent.on(hiddenContainer, 'mouseover', this._mouseover,this);
//         L.DomEvent.on(hiddenContainer, 'mouseout', this._mouseout,this);
//         L.DomEvent.disableClickPropagation(hiddenContainer);

//         this.hiddenContainer = hiddenContainer;
//         this.button = button;

//         return container;
//       },
//       _click : function () {
//       },
//       _mouseover : function () {
//         this.hiddenContainer.style.display ="block";
//         this.button.style.display ="none";
//       },
//       _mouseout : function () {
//         this.hiddenContainer.style.display ="none";
//         this.button.style.display ="block";
//       },
//       setContent: function(text){
//         this.hiddenContainer.innerHTML = text;
//       }
//     });

//     if(level>0){
//     var control = new L.CustomControl().addTo(map)
//     control.setContent('<h7><b>'+subtitle+'</b></h7><br><h7>'+filter+'</h7> <table class="legend-table" >'+
// 	'<tr><td><i style="background-color:' + colors[0]  + ';"></i></td><td> ' +legend_array[0] + '-'+ legend_array[1] +'  ('+ count[0] +')'+'</td></tr>'+
// 	'<tr><td><i style="background-color:' + colors[1]  +';"></i></td></td><td> ' +legend_array[1] + '-'+ legend_array[2] +'  ('+ count[1] +')'+'</td></tr>'+
// 	'<tr><td><i style="background-color:' + colors[2]  + ';"></i></td></td><td> ' +legend_array[2] + '-'+ legend_array[3] +'  ('+ count[2] +')'+'</td></tr>'+
// 	'<tr><td><i style="background-color:' + colors[3]  + ';"></i></td></td><td> ' +legend_array[3] + '-'+ legend_array[4] +'  ('+ count[3] +')'+'</td></tr>'+
// 	'<tr><td><i style="background-color:' + colors[4]  + ';"></i></td></td><td> ' +legend_array[4] + '-'+ legend_array[5] +'  ('+ count[4] +')'+'</td></tr></table>')

// }

// else{

//     var control = new L.CustomControl().addTo(map)
//     control.setContent('<h7><b>'+subtitle+'</b></h7><br><h7>'+filter)

// }
// }


  

//   })(i);

// }



//  function data_extract(item, index, arr) {


//       // dimension_object=dimension_object+'"'+index+'":"'+item+'",';


// 		var  populatedPlacesSource = new carto.source.SQL(`
// 		  SELECT *
// 		    FROM level`+level+`
// 		    WHERE id = '`+item[1]+`'
// 		`);

//     var color;


//     var colors= ['#ffffd4','#fed98e','#fe9929','#d95f0e','#993404'];


//     if(item[3]>=legend_array[0] && item[3]<=legend_array[1]){

//       color = colors[0];
//       count[0]=count[0]+1
//     }

//     else if(item[3]>legend_array[1] && item[3]<=legend_array[2]){

//       color = colors[1];
//        count[1]=count[1]+1
//     }

//     else if(item[3]>legend_array[2] && item[3]<=legend_array[3]){

//       color = colors[2];
//        count[2]=count[2]+1
//     }

//      else if(item[3]>legend_array[3] && item[3]<=legend_array[4]){

//       color = colors[3];
//        count[3]=count[3]+1
//     }

//      else if(item[3]>legend_array[4] && item[3]<=legend_array[5]){

//       color = colors[4];
//        count[4]=count[4]+1

//     }

//      else{

//       color = 'black'
//     }

// 		var populatedPlacesStyle = new carto.style.CartoCSS(`
// 		  #layer {
// 		            polygon-fill: `+color+`;
// 		            polygon-opacity: 0.9;
// 		          }
// 		`);


//     var placeBoundaries = new carto.style.CartoCSS(`

//        #layer {
//                 weight: 5,
//                 color: '#666',
//                 dashArray: '',
//                 fillOpacity: 0.7
//               }
//     `);
	


// 		var populatedPlaces = new carto.layer.Layer(populatedPlacesSource, populatedPlacesStyle, {
// 		  featureOverColumns: ['name']
// 		});

// 		var popup = L.popup({ closeButton: false });
// 		populatedPlaces.on(carto.layer.events.FEATURE_OVER, featureEvent => {

// 		  popup.setLatLng(featureEvent.latLng);
// 		  if (!popup.isOpen()) {
// 		    popup.setContent(featureEvent.data.name+'('+item[3]+')');
// 		    popup.openOn(maps[vis_ids]);
// 		  }
// 		});


// 		populatedPlaces.on(carto.layer.events.FEATURE_OUT, featureEvent => {
// 		  popup.removeFrom(maps[vis_ids]);
// 		});


//     // populatedPlaces.on('featureOver', function(e, latlng, pos, data, subLayerIndex) {
//     // popup.setLatLng(e.latLng);
//     // if (!popup.isOpen()) {
//     //     popup.setContent(e.data.name+'('+item[3]+')');
//     //     popup.openOn(maps[vis_ids]);
//     //   }

//     // console.log('e',e)
//     // // console.log('lat',e.latLng)
//     // // console.log('pos',e.position)
//     // // console.log('data',e.data)

//     // // console.log("the vis ids",vis_ids)


//     // });


//     // populatedPlaces.on('featureOut', function(e, latlng, pos, data, layer) {
//     //   popup.removeFrom(maps[vis_ids]);
//     // });




// 		 client.addLayer(populatedPlaces);

// 		 client.getLeafletLayer().addTo(maps[vis_ids]);

// 		  }




