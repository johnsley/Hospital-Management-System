$(document).ready(function(){
	$("#show").click(function(){
		$("#add").slideDown(1000);
		$("#show").fadeOut();
	});	
	$("#hide").click(function(){
		$("#add").slideUp(1000);
		$("#show").fadeIn();
	})
	$("#show_itr").click(function(){
		$("#add_itr").slideDown(1000);
		$("#show_itr").fadeOut();
		$("#d_record").fadeOut();
	});
	$("#hide_itr").click(function(){
		$("#add_itr").slideUp(1000);
		$("#show_itr").fadeIn();
		$("#d_record").fadeIn();
	})
	$("#show_fdental").click(function(){
		$("#p_fdental").slideUp(1000);
		$("#dental_form").fadeIn();
	});
	
	$('#show_com').click(function(){
		$("#com").slideDown(1000);
		$("#show_com").fadeOut();
	});
	$('#hide_com').click(function(){
		$("#com").slideUp(1000);
		$("#show_com").fadeIn();
	});
    // start
	$('#show_checkup').click(function(){
		$("#add_checkup").slideDown(1000);
		$("#show_checkup").fadeOut();
	});
	$('#hide_checkup').click(function(){
		$("#add_checkup").slideUp(1000);
		$("#show_checkup").fadeIn();
	});

	// doctor
	$('#show_doc').click(function(){
		$("#add_doc").slideDown(1000);
		$("#show_doc").fadeOut();
	});
	$('#hide_doc').click(function(){
		$("#add_doc").slideUp(1000);
		$("#show_doc").fadeIn();
	});

	// appointment
	$('#show_appointment').click(function(){
		$("#add_appointment").slideDown(1000);
		$("#show_appointment").fadeOut();
	});
	$('#hide_appointment').click(function(){
		$("#add_appointment").slideUp(1000);
		$("#show_appointment").fadeIn();
	});
});

$("#item").change(function() {
var idVar = $(this).val(); 
$.ajax({
    url:"get_serviceprice.php",
    type:"POST",
    data: {itemid: idVar},
    async:true,
    success: function(data) {
        document.getElementById("price").value = data;
        document.getElementById("amount").value = data * document.getElementById("qty").value;
        },
    error: function() {
        }
    });
});

function myFunction(inputv) {
	var total = inputv * document.getElementById("price").value;
    document.getElementById("amount").value = total;
}
function myPrice(inpuprice) {
	var total = inpuprice * document.getElementById("qty").value;
    document.getElementById("amount").value = total;
}

 $("#item2").change(function() {
var idVar = $(this).val(); 
$.ajax({
    url:"get_serviceprice.php",
    type:"POST",
    data: {itemid: idVar},
    async:true,
    success: function(data) {
        document.getElementById("price2").value = data;
        document.getElementById("amount2").value = data * document.getElementById("qty2").value;
        },
    error: function() {
        }
    });
});

function myFunction2(inputv) {
	var total = inputv * document.getElementById("price2").value;
    document.getElementById("amount2").value = total;
}
function myPrice2(inpuprice) {
	var total = inpuprice * document.getElementById("qty2").value; 
    document.getElementById("amount2").value = total;
}

$("#item3").change(function() {
var idVar = $(this).val(); 
$.ajax({
    url:"get_serviceprice.php",
    type:"POST",
    data: {itemid: idVar},
    async:true,
    success: function(data) {
        document.getElementById("price3").value = data;
        document.getElementById("amount3").value = data * document.getElementById("qty3").value;
        },
    error: function() {
        }
    });
});

function myFunction3(inputv) {
	var total = inputv * document.getElementById("price3").value;
    document.getElementById("amount3").value = total;
}
function myPrice3(inpuprice) {
	var total = inpuprice * document.getElementById("qty3").value; 
    document.getElementById("amount3").value = total;
}