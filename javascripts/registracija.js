
$('registracija').ready(function(){
    
    var validno = /^[A-ZŠĐŽČĆ][a-zšđžčć]+$/;

//Provjera Ime
    $("#ime").focusout(function(event){
        var ime=$("#ime").val();
        if(!validno.test(ime)){
                $("#ime").css("box-shadow", "0 0 5px red");
                $("#ime").focus();
                $("#imeg").html("Ime nije ispravno uneseno! ");
                $("#imeg").css("color","red");
        }
        else {
                $("#ime").css("box-shadow", "0 0 5px green");
                $("#imeg").html("Ime");
                $("#imeg").css("color","green");
        }
    });

//Provjera Prezime
    $("#prezime").focusout(function(event){
        var prezime=$("#prezime").val();
        if(!validno.test(prezime)){
                $("#prezime").css("box-shadow", "0 0 5px red");
                $("#prezime").focus();
                $("#prezimeg").html("Prezime nije ispravno uneseno (Samo prvo slovo veliko)! ");
                $("#prezimeg").css("color","red");
        }
        else {
                $("#prezime").css("box-shadow", "0 0 5px green");
                $("#prezimeg").html("Prezime");
                $("#prezimeg").css("color","green");
        }
    });

//Provjera Lozinke
    $("#lozinka").focusout(function(event){
        var loz=$("#lozinka").val();        
        if(loz.length<6){
            $("#lozinka").css("box-shadow", "0 0 5px red");
            $("#lozinka").focus();
            $("#lozinkag").html("Lozinka mora sadrzavati MIN 6 znakova! ");
            $("#lozinkag").css("color","red");
        }
        else {
                $("#lozinka").css("box-shadow", "0 0 5px green");
                $("#lozinkag").html("Lozinka");
                $("#lozinkag").css("color","green");
        }

    });
    
//Provjera ponovljene lozinke
    $("#plozinka").focusout(function(event){
        var loz=$("#lozinka").val();
        var ploz=$("#plozinka").val();
        
        for (var i = 0; i < loz.length; i++) {
        if(loz[i] !== ploz[i] || loz.length !== ploz.length){
            $("#plozinka").css("box-shadow", "0 0 5px red");
            $("#plozinka").focus();
            $("#plozinkag").html("Lozinke se ne podudaraju! ");
            $("#plozinkag").css("color","red");
            return false;
        }
        $("#plozinka").css("box-shadow", "0 0 5px green");
        $("#plozinkag").html("Ponovi lozinku");
        $("#plozinkag").css("color","green");
    }

    });
    
//Provjera Korisničkog imena      
    $("#korisnickoIme").focusout(function(event){
        var korisnicko=$("#korisnickoIme").val();
        console.log("Vrijednost korisnickog unosa: "+ korisnicko);
        
        if(korisnicko.length<5){
            $("#korisnickoIme").css("box-shadow", "0 0 5px red");
            $("#korisnickoIme").focus();
            $("#greske").html("Korisničko ime (Min 6 znakova)! ");
            $("#greske").css("color","red");
        }
        else {
            $("#korisnickoIme").css("box-shadow", "0 0 5px green");
            $("#greske").html("Korisničko ime");
            $("#greske").css("color","green");
        }

    });

//Provjera E-maila
    $("#email").focusout(function(event){
        var email=$("#email").val();
        var zas=0;
        var validno = /^[a-zA-Z0-9._-]+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/i;
        if(!validno.test(email)){  zas=1;  }

        if(zas==1){
            $("#email").css("box-shadow", "0 0 5px red");
            $("#email").focus();
            $("#greske1").html("E-mail adresa nije valjana!");
            $("#greske1").css("color","red");
        }
        else {
            $("#email").css("box-shadow", "0 0 5px green");
            $("#greske1").html("E-mail");
            $("#greske1").css("color","green");
        }

    });
 
//Gradovi
    var gradovi = new Array();
    $.getJSON( "http://localhost:3000/javascripts/gradovi.json", function( data ) {
      $.each( data, function( key, val ) {
        console.log(val);
        gradovi.push(val);
        });
    });
    
    $("#grad").autocomplete({
        source: gradovi
    });

});