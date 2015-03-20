var debug_mode = false;
var count = 0;

$(document).ready(function(){
	// 1000px is the cut off for the responsive layout
	if($(window).width() >= 1000){
		$("body").prepend("<div id='debug'>Debug Mode: <input type='checkbox' id='debugbox' /></div><div id='prompt_msg'>Click the checkbox to activate the debug mode. Double-click on any area of the webpage to add a bug!<a class='close' href='#' onclick='javascript:closeMsg(this)'></a><input type='hidden' class='bugid' value='' /></div><div id='control_panel'><form id='formCP' method='post' target='_blank' action='/canbii/debugger/controlpanel.php'><input id='uID' name='uID' type='hidden' value='' /><button id='c_panelbutton'>Control Panel</button></form></div>");
	}
	else{
		$("body").prepend("<div id='prompt_msg'>Window width is too small to debug.<a class='close' href='#' onclick='javascript:closeMsg(this)'></a></div>");
	}
	$("#prompt_msg").hide().slideDown("slow");
	
	if($("uID").val() !== ""){		
		getBugsByURL();
	}
	$(".commentbox").hide();
	
	$(document).on("click",".savebtn",function(){
		if($(this).html() == "Edit"){
			editBug(this);
		}
		else{
			saveBug(this);
		}
	});
	
	// $(window).resize(function(){
		// if($(window).width() > 1000){
			 // $(".commentbox").each(function(i,e){
				// $(e).css("backgroundColor","red");
				// widthDiff = 0;
				// divLeft = $(e).css("left");
				// if($(window).width() < $(e).attr('data-winWidth') ){
					// widthDiff = ($(e).attr('data-winWidth') - $(window).width()) / 2;
					// $(e).css("left",(divLeft-widthDiff));
					
				// console.log("lesser - "+widthDiff);
				// }
				// else if($(window).width() > $(e).attr('data-winWidth') ){
					// widthDiff = ($(window).width() -$(this).attr('data-winWidth')) / 2;
					// $(e).css("left",parseFloat(divLeft)-widthDiff);
				// console.log("greater - "+widthDiff);
				// }
				
				
				// //$( ".draggable" ).draggable();
			// });
		// }
	// });
	
	$("#formCP").on("submit",function(e){
		$("#uID").val($("#canbii_userID").val());
		$("#formCP").submit();
	});
	
	$("#debugbox").click(function(){
		if($("#debugbox").is(":checked")){
			debug_mode = true;
			$("#control_panel").show();
			$(".commentbox").slideDown();
		}
		else{
			debug_mode = false;
			$("#control_panel").hide();
			$(".commentbox").hide();
		}
	});
	
	// $(".draggable").on("hover",function(e){
		// if ($(e.target).is("textarea, a, button")){
			// $(e).css("cursor","pointer");
		// }
		// else{
			// $(e).css("cursor","move");			
		// }
	// });
	
	$("body").dblclick(function(e){
		console.log($(e.target));
			
		if($(e.target).is('#debugbox')){
			debug_mode = true;
			count ++;
			$("#prompt_msg").slideUp("slow");
			return;
		}
		if($(e.target).is('.commentbox > textarea, .commentbox > .close, .commentbox > .savebtn, #prompt_msg > .close')){
			return;
		}
		else if ($(e.target).is('.commentbox, #prompt_msg')){
			return;
		}
		else if(debug_mode == true && $("#debugbox").is(":checked")){
			createMsg(e);
		}
	});
});

function createMsg(element){
	// var posX = $(this).offset().left,
    // posY = $(this).offset().top;
	var x = element.pageX;
	var y = element.pageY;
	$("body").append($("<div class='commentbox draggable'><a class='close' href='#' onclick='javascript:closeMsg(this)'></a><textarea class='commenttext'></textarea><span class='bug_dateMod'></span><button class='savebtn'>Save</button><input type='hidden' class='bugid' value='' /></div>").offset({left:x-37,top:y}));  
	$( ".draggable" ).draggable();
}

function getBugsByURL(){
	counter = 0;
	$.ajax({
	async:false,
		type: "POST",
		url: "/canbii/debugger/script.php",
		data: {			
			funct:"getBugsByURL",
			url:window.location.href,
			userID:$("#canbii_userID").val()
		},
		success: function(bugs){
			console.log(bugs);
			if(bugs !== false){
				$.each(bugs,function(i,e){
					var bugDate = e['dateMod'];
					
					$("body").append($("<div data-winWidth='"+ e['windowX'] +"' class='commentbox draggable' style='top:"+ e['positionY'] +"px;left:"+ e['positionX']  +"px'><a class='close' href='#' onclick='javascript:closeMsg(this)'></a><textarea class='commenttext'>"+e['comment'] +"</textarea><span class='bug_dateMod'>"+ bugDate +"</span><button class='savebtn'>Save</button><input type='hidden' class='bugid' value='"+ e['id'] +"' /></div>"));  
					widthDiff = 0;
					
					
					if($(window).width() < e['windowX']){
						widthDiff = (e['windowX'] - $(window).width()) / 2;
						$(".commentbox:eq("+counter+")").css("left",(e['positionX'] - widthDiff));
					}
					else if($(window).width() > e['windowX']){
						widthDiff = ($(window).width() -e['windowX']) / 2;
						console.log(parseFloat(e['positionX']) + widthDiff)
						$(".commentbox:eq("+counter+")").css("left",parseFloat(e['positionX']) + widthDiff);
					}
					
					// console.log(counter + " - " +widthDiff)
					
					counter ++;
					$( ".draggable" ).draggable();
				});
			}
		},
		dataType:"json"
	});
}

function closeMsg(e){
	$(e).parent().remove();
}

function saveBug(e){
	var type="addBug";
	if(typeof $(e).next(".bugid").val() !== typeof undefined && $(e).next(".bugid").val() !== ""){
		type="updateBug";
	}
	$.ajax({
		type: "POST",
		url: "/canbii/debugger/script.php",
		data: {
			comment:$(e).parent('.commentbox').find('.commenttext').val(),
			positionY:$(e).parent(".commentbox").offset().top,
			positionX:$(e).parent(".commentbox").offset().left,
			winHeight:$(window).height(),
			winWidth:$(window).width(),
			url:window.location.href,
			bugID:$(e).next(".bugid").val(),
			userID:$("#canbii_userID").val(),
			funct:type
		},
		success: function(prompt){
			console.dir(prompt);
			if(prompt !== "false"){
				var newHeight = $(e).parent(".commentbox").height() - 30;
				var newHeight2 = $(e).parent(".commentbox").find('.commenttext').height() - 30;
				
				$(e).parent(".commentbox").find('.commenttext').animate({height:newHeight2 });
				$(e).parent(".commentbox").find('.commenttext').attr("disabled","disabled");
				
				$(e).parent(".commentbox").animate("slow",function(){
					$(this).find(".bug_dateMod").text(prompt['dateModified']);
					$(this).height(newHeight);
				});
				
				console.log(prompt['dateModified']);
				$(e).next(".bugid").val(prompt['id']);
				$(e).html("Edit"); 
				//$(e).attr("onclick","javascript:editBug(this);");
				$(e).css("background","#CCC");
				
				$(e).parent(".commentbox").draggable('disable');
				$(e).parent(".commentbox").removeClass("draggable");
			}
			else{
			
			}
		},
		dataType:"json"
	});

	
	
}

function editBug(e){
	var newHeight = $(e).parent(".commentbox").height() + 30;
	var newHeight2 = $(e).parent(".commentbox").find('.commenttext').height() + 30;
    $(e).parent(".commentbox").animate({height:newHeight });
    $(e).parent(".commentbox").find('.commenttext').animate({height:newHeight2 });
	$(e).parent(".commentbox").find('.commenttext').removeAttr("disabled");
	$(e).html("Save"); 
	//$(e).attr("onclick","javascript:saveBug(this);");
	$(e).css({
		background:"#215d85",		
		backgroundImage: "-webkit-linear-gradient(top, #215d85, #2980b9)",
		backgroundImage: "-moz-linear-gradient(top, #215d85, #2980b9)",
		backgroundImage: "-ms-linear-gradient(top, #215d85, #2980b9)",
		backgroundImage: "-o-linear-gradient(top, #215d85, #2980b9)",
		backgroundImage: "linear-gradient(to bottom, #215d85, #2980b9)"
	});
	
	$(e).parent(".commentbox").draggable('enable');
	$(e).parent(".commentbox").addClass("draggable");
}

