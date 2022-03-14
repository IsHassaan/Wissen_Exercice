var a=1;
var b=1;
function showSidebar(){
   if(a==1){
    document.getElementById("sidebar_links").style.display="flex";
    return a=0;
   }
   else{
    document.getElementById("sidebar_links").style.display="none";
    return a=1;
   }
}
function hideSidebar(){
   document.getElementById("sidebar_links").style.display="none";
}


function showPost(){
   document.getElementById("uploadpost").style.display="block"; 
   document.getElementById("close_u").style.display="block";

}
function closeUpload(){
   document.getElementById("uploadpost").style.display="none";
   document.getElementById("close_u").style.display="none";
}


function showEdit(){
   document.getElementById("edit_p").style.display="block";
   document.getElementById("close_p").style.display="block";
}
function closePost(){
   document.getElementById("edit_p").style.display="none";
   document.getElementById("close_p").style.display="none";
}

function showEditPost(){
   document.getElementById("edit_post").style.display="block";
   document.getElementById("close_ep").style.display="block";
}
function closeEditPost(){
   document.getElementById("edit_post").style.display="none";
   document.getElementById("close_ep").style.display="none";
}


