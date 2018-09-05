function addPoint1(id) {
 	$.ajax({
       type: "POST",
	   url: '/ajax/addpoint1/',
	   cache:false,
	   data: {
           action_ajax_addpoint1: 'true',
           asobikata_id: id
	   },
       dataType: "json",
           success: function(dt){
               if(dt == 0) {
			     point = parseInt($("#point_1_"+id).html());
			     $("#point_1_"+id).html(point+1);
			   }
		   }
   });

}


function addPoint3(id) {
 	$.ajax({
       type: "POST",
	   url: '/ajax/addpoint3/',
	   cache:false,
	   data: {
           action_ajax_addpoint3: 'true',
           asobikata_id: id
	   },
       dataType: "json",
           success: function(dt){
               if(dt == 0) {
			     point = parseInt($("#point_3_"+id).html());
			     $("#point_3_"+id).html(point+1);
			   }
		   }
   });

}
