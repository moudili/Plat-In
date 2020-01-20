$(function() {

    $("#User,#FirstName,#LastName,#Adress,#Mail,#Phone,#Pwd,#Cpwd,#SignUp").focusout(function() {

        var User = document.forms["FormName"]["ndu"].value;
        var FirstName = document.forms["FormName"]["first_name"].value;
        var LastName = document.forms["FormName"]["last_name"].value;
        var Adress = document.forms["FormName"]["adresse"].value;
        var Mail = document.forms["FormName"]["mail"].value;
        var Phone = document.forms["FormName"]["phone"].value;
        var Pwd = document.forms["FormName"]["mdp"].value;
        var Cpwd = document.forms["FormName"]["cmdp"].value;
        
        //User

        if(User.length !== 0
            && (User.length  < 5
            || User.length > 40)
            )
        {
            document.getElementById("User").style.borderColor="red";
        }
        else if(User.length > 4
            && User.length < 41
            )
        {
            document.getElementById("User").style.borderColor="green";
        }
        else if(User.length == 0)
        {
            document.getElementById("User").style.borderColor="";
        }

        //First Name

        if(FirstName.length !== 0
            && (FirstName.length  < 2
            || FirstName.length > 40
            || FirstName.match(/[^a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]/))
            )
        {
            document.getElementById("FirstName").style.borderColor="red";
        }
        else if(FirstName.length > 1
            && FirstName.length < 41
            )
        {
            document.getElementById("FirstName").style.borderColor="green";
        }
        else if(FirstName.length == 0)
        {
            document.getElementById("FirstName").style.borderColor="";
        }

        //LastName

        if(LastName.length !== 0
            && (LastName.length  < 2
            || LastName.length > 40
            || LastName.match(/[^a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]/))
            )
        {
            document.getElementById("LastName").style.borderColor="red";
        }
        else if(LastName.length > 1
            && LastName.length < 41
            )
        {
            document.getElementById("LastName").style.borderColor="green";
        }
        else if(LastName.length == 0)
        {
            document.getElementById("LastName").style.borderColor="";
        }

        //Adress


        if(Adress.length !== 0
            && (Adress.length  < 2
            || Adress.length > 40)
            //|| !Adress.match(/^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ'._-]$/))
            )
        {
            document.getElementById("Adress").style.borderColor="red";
        }
        else if(Adress.length > 1
            && Adress.length < 41
            )
        {
            document.getElementById("Adress").style.borderColor="green";
        }
        else if(Adress.length == 0)
        {
            document.getElementById("Adress").style.borderColor="";
        }

        //Mail

        if(Mail.length !== 0
            && (Mail.length  < 7
            || Mail.length > 40
            || !Mail.match(/^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ'._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/))
            )
        {
            document.getElementById("Mail").style.borderColor="red";
        }
        else if(Mail.length > 6
            && Mail.length < 41
            )
        {
            document.getElementById("Mail").style.borderColor="green";
        }
        else if(Mail.length == 0)
        {
            document.getElementById("Mail").style.borderColor="";
        }

        //Phone

        if(Phone.length !== 0
            && (Phone.length  < 2
            || Phone.length > 40
            || !Phone.match(/^([\s()+-]?[0-9]){10}[\s()+-]?$/))
            )
        {
            document.getElementById("Phone").style.borderColor="red";
        }
        else if(Phone.length > 3
            && Phone.length < 41
            )
        {
            document.getElementById("Phone").style.borderColor="green";
        }
        else if(Phone.length == 0)
        {
            document.getElementById("Phone").style.borderColor="";
        }

        //Pwd

        
        if(Pwd.length !== 0
            && (Pwd.length  < 5
            || Pwd.length > 40)
            )
        {
            document.getElementById("Pwd").style.borderColor="red";
        }
        else if(Pwd.length > 4
            && Pwd.length < 41
            )
        {
            document.getElementById("Pwd").style.borderColor="green";
        }
        else if(User.length == 0)
        {
            document.getElementById("Pwd").style.borderColor="";
        }

        //Cpwd


        if(Cpwd.length !== 0
            && (Cpwd.length  < 5
            || Cpwd.length > 40
            || Cpwd !== Pwd)
            )
        {
            document.getElementById("Cpwd").style.borderColor="red";
        }
        else if(Cpwd.length > 4
            && Cpwd.length < 41
            && Cpwd == Pwd
            )
        {
            document.getElementById("Cpwd").style.borderColor="green";
        }
        else if(User.length == 0)
        {
            document.getElementById("Cpwd").style.borderColor="";
        }


    });

    

});