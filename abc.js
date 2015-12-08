jQuery(document).ready(function() {


	// Animated Slide 2
	jQuery('.tabs .tab-links a').on('click', function(e)  {
		var currentAttrValue = jQuery(this).attr('href');

		// Show/Hide Tabs
		jQuery('.tabs ' + currentAttrValue).slideDown(400).siblings().slideUp(400);

		// Change/remove current tab to active
		jQuery(this).parent('li').addClass('active').siblings().removeClass('active');

		e.preventDefault();
	});

	$("body").on("click", "#addnew", function(){

		var fname = document.getElementById("addfirstname").value;
		var lname = document.getElementById("addlastname").value;

		var e = document.getElementById("addnum");
		var phonetype = e.options[e.selectedIndex].value;
		var phonenum = document.getElementById("addnumber").value;

		var p = document.getElementById("addhouse");
		var addtype = p.options[p.selectedIndex].value;
		var bname = document.getElementById("addbuildingname").value;
		var sname = document.getElementById("addstreetname").value;

		var pwd = document.getElementById("pwd").value;

		
		var data = [fname, lname, phonetype, phonenum, addtype, bname, sname, pwd];
		
		var jsonString = JSON.stringify(data);
		$.ajax({
	       type: "POST",
	       url: 'connection.php',
	       data:{action:'adduser', data: jsonString},
			       success:function(data) {
			       	// $("#users tr").remove(); 
			       	var table = document.getElementById('users');
					while (table.rows.length > 2)
					    table.deleteRow(2);
			       	alert("added  : "+data);

			       	 		$.ajax({
							       type: "POST",
							       url: 'connection.php',
							       //dataType: 'json',
							       data:{action:'loadtable'},
									       success:function(data) {
									       var r = JSON.parse(data);
									       var el=0;
									       for(var iter=0; iter<r.length/3; iter++)
									       	{
									       		myFunction(r[el],r[el+1],r[el+2]);
									       		el=el+3;
									       	}
									       },
									       failure:function(){
									       	alert("user not added");
									       }
									 });
			       	 		
			       	 $('.overlay-bg, .overlay-content').hide();
			       },
			       failure:function(){
			       	alert("user not added");
			       }
			 });

		//3$('.overlay-bg, .overlay-content').hide(); //hide the overlay



});

$("body").on("keyup", "#searchhere", function(e){

	if(e.keyCode == 8 || e.keyCode == 16)
	{
		$("#result").html("");
	}

	var s = document.getElementById("searchselect");
	var t = s.options[s.selectedIndex].value;
	var search = document.getElementById("searchhere").value;
	
	    $.ajax({
	       type: "POST",
	       url: 'connection.php',
	       data:{action:'search', 'type': t, 'search': search },
			       success:function(data) {
			       		var result = JSON.parse(data);
			       		var cc=0;
			       		for(var i=0; i<result.length/2;i++)
			       		{
			       			$("#result").append("<b><u>User id </u></b>: "+result[cc]+"      "+"<b><u>first name </u></b>: "+result[cc+1]+"</br>");
			       			cc=cc+2;
			       		}
			       		//console.log(result);
			       		
			       }

			});
});


	$("body").on("click", ".delete", function(){

		var idd = document.getElementById("users").rows[this.id].cells[0].innerHTML;

		var id = this.class;
		console.log(id);

		 $.ajax({
	       type: "POST",
	       url: 'connection.php',
	       data:{action:'delete', data: idd},
			       success:function(data) {
			       	alert(data);
			       	$("."+id).remove();
			       }

			  });


	});




	$("body").on("click", ".edit", function(){

       // $("#edit"+this.id).attr("contenteditable","true");
	    $("#edit"+this.id).css('background', 'red');
	    $("#edit"+this.id).css('color', 'white');



	    var id = document.getElementById("users").rows[this.id].cells[0].innerHTML;

	    $.ajax({
	       type: "POST",
	       url: 'connection.php/abc',
	       data:{action:'call_this', data: id},
			       success:function(data) {

			       	//alert(data);

			             var result = JSON.parse(data);
			             
			             if(result[0]=="1")
			             {
			             	alert("log in to continue");
			             }

			             else{
			             		if(result[0]=="")
			             		{
			             			$("#editfirstname").attr("placeholder", "enter first name here");
			             		}
			             		else{
			             			$("#editfirstname").val(result[0]);
			             		}

			             		if(result[1]=="")
			             		{
			             			$("#editfirstname").attr("placeholder", "enter first name here");
			             		}
			             		else{
			            			$("#editlastname").val(result[1]);
			            		}

			            		if(result[2]=="mobile")
			            		{
			            			$("#num").val('mobile');
			            		}
			            		else{
			            			$("#num").val('landline');
			            		}

			            		if(result[3]=="")
			            		{
			            			$("#number").attr("placeholder", "enter number here");
			            		}
			            		else{
			            			$("#number").val(result[3]);
			            		}

			            		if(result[4]=="permanent")
			            		{
			            			$("#house").val('permanent');
			            		}
			            		else{
			            			$("#house").val('temporary');
			            		}

			            		if(result[5]=="")
			            		{
			            			$("#buildingname").attr("placeholder", "enter building name here");
			            		}
			            		else{
			            			$("#buildingname").val(result[5]);
			            		}

			            		if(result[6]=="")
			            		{
			            			$("#streetname").attr("placeholder", "enter street name here");
			            		}
			            		else{
			            			$("#streetname").val(result[6]);
			            		}

			            		if(result[6]=="")
			            		{

			            		}
			            		else{

			            		}

			            		if(result[7]=="")
			            		{

			            		}
			            		else{

			            		}


			         		}

			           }
	    		});


   		 });

    

$.ajax({
	       type: "POST",
	       url: 'connection.php',
	       //dataType: 'json',
	       data:{action:'loadtable'},
			       success:function(data) {
			       var r = JSON.parse(data);
			       var el=0;
			       for(var iter=0; iter<r.length/3; iter++)
			       	{
			       		myFunction(r[el],r[el+1],r[el+2]);
			       		el=el+3;
			       	}
			       },
			       failure:function(){
			       	alert("user not added");
			       }
			 });





});






function myFunction(a, b,count) {

    var table = document.getElementById("users");
    var row = table.insertRow(count);
    row.setAttribute('id',"row"+count);

    var but=document.createElement("BUTTON");
    but.setAttribute('id',count);
    but.setAttribute('class',"edit");
    but.innerHTML= "EDIT";

    var del=document.createElement("BUTTON");
    del.setAttribute('id',a);
    del.setAttribute('class',"delete");
    del.innerHTML= "DELETE";

    var cell1 = row.insertCell(0);
    cell1.setAttribute('class',"edit");
    cell1.setAttribute('id',"user"+count);
    cell1.setAttribute('contenteditable',"false");

    var cell2 = row.insertCell(1);
    cell2.setAttribute('class',"u");
    cell2.setAttribute('id',"edit"+count);
    cell2.setAttribute('contenteditable',"false");

    var cell3 = row.insertCell(2);
    cell3.setAttribute('class',"u");

    var cell4 = row.insertCell(3);
    cell4.setAttribute('class',"u");

    cell1.innerHTML = a;
    cell2.innerHTML = b;
    cell3.appendChild(but);
    cell4.appendChild(del);
}




$(document).ready(function(){
 
    // function to show our popups
    function showPopup(whichpopup){
        var docHeight = $(document).height(); //grab the height of the page
        var scrollTop = $(window).scrollTop(); //grab the px value from the top of the page to where you're scrolling
        $('.overlay-bg').show().css({'height' : docHeight}); //display your popup background and set height to the page height
        $('.popup'+whichpopup).show().css({'top': scrollTop+20+'px'}); //show the appropriate popup and set the content 20px from the window top
    }
 
    // function to close our popups
    function closePopup(){
        $('.overlay-bg, .overlay-content').hide(); //hide the overlay
    }
 
 
    // show popup when you click on the link
    $('.show-popup').click(function(event){
        event.preventDefault(); // disable normal link function so that it doesn't refresh the page
        var selectedPopup = $(this).data('showpopup'); //get the corresponding popup to show
         
        showPopup(selectedPopup); //we'll pass in the popup number to our showPopup() function to show which popup we want
    });
   
    // hide popup when user clicks on close button or if user clicks anywhere outside the container
    $('.close-btn, .overlay-bg').click(function(){
        closePopup();
    });
     
    // hide the popup when user presses the esc key
    $(document).keyup(function(e) {
        if (e.keyCode == 27 || e.keyCode == 13) { // if user presses esc key
            closePopup();
        }
    });
});