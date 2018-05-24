/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function removeBookmark(remId)
{
    var answer = confirm('Are you sure you want to delete this bookmark?');
    if (answer)
    {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            //redystate==4 <-- done
            //status==200 <-- successful request 
            if (this.readyState == 4 && this.status == 200) {
                location.reload(); //this.responseText <-- value from php echo
            }
        };
        xmlhttp.open("GET", "index.php?controller=home&action=removeBookmark&removeId=" + remId, true);
        xmlhttp.send();
    }
}

function removeFolder(remId)
{
    var answer = confirm('Are you sure you want to delete this Folder with whole its content?');
    if (answer)
    {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                location.reload();
            }
        };
        xmlhttp.open("GET", "index.php?controller=home&action=removeFolder&removeId=" + remId, true);
        xmlhttp.send();
    }
}

$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
});

$(document).on("click", ".open-editModal", function () {
    var Id = $(this).data('id');

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        //redystate==4 <-- done
        //status==200 <-- successful request 
        if (this.readyState == 4 && this.status == 200) 
        {
            var response = this.responseText;
            response = response.split("</body>")[0];
            response = response.split("<br/><br/><br/>")[1];
            response = response.trim();
            response = response.split("#");
            
            document.getElementById("editParent").value = response[0];
            document.getElementById("editName").value = response[1];
            document.getElementById("editUrl").value = response[2];
            document.getElementById("editId").value = response[3];
        }
    };
    xmlhttp.open("GET", "index.php?controller=home&action=getEditBookmarkData&editId=" + Id, true);
    xmlhttp.send();
});

$(document).on("click", ".open-editFolderModal", function () {
    var Id = $(this).data('id');
    
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) 
        {
            var response = this.responseText;
            response = response.split("</body>")[0];
            response = response.split("<br/><br/><br/>")[1];
            response = response.trim();
            response = response.split("#");
                    
            document.getElementById("editFolderParent").value = response[0];
            document.getElementById("editFolderName").value = response[1];
            document.getElementById("editFolderId").value = response[2];
        }
    };
    xmlhttp.open("GET", "index.php?controller=home&action=getEditFolderData&editId=" + Id, true);
    xmlhttp.send();
});
