<!-- ---------------------------
STAPA ACCES - page connexion

V 0.1.06
---------------------------- -->
<?php

function display_connect_page($error=""){
    if($error!=''){
        $error = "<style>#error_connect{color:red;}</style><p id='error_connect'>
                Login ou Mot de passe invalide</p>";
    }

    echo '<!DOCTYPE html>
    <html lang="fr">
    
    <head>
    
        <title>Stapa Access</title>
        <meta charset="utf-8">	
        <meta name="description" content="page">	
        <meta name="robots" content="noindex,nofollow">		
    
    
        <meta name="author" content="Team_Seven">	
        <meta name="copyright" content="Team_Seven">
    
        <link href="images/favicon.png" rel="shortcut icon" type="image/png">
        <link href="css/index_style.css" rel="stylesheet" type="text/css">		
  
                
                <header>	
    
                    <hgroup id="bann_m">
                        <h2>
                        <a>S T A P A</a> 
                        <a>A C C E S</a>
                        <picture  id="logo_m">
                            <img src="images/bus_t.png"  alt="-image-">
                        </picture>
                        </h2>
                    </hgroup>
                    
                </header>
    
            </section>
            
            <section>															<!-- début main -->
                
                <main>
                <div id="main_bg">
                
                    <section id="main_m">						
                    
                        <form id="connect" action="index.php" method="post">
                            '.$error.'
                            <p>
                                <a><label for="ID">Identifiant</label></a><br/>
                                <input name="ID" required placeholder/>
                            </p>
                            <p>
                                <a><label for="PSW">Mot de Passe</label></a><br/>
                                <input name="PSW" type="password" required placeholder/>
                            </p>
                            <p>
                                <a><input id="sub" value="CONNEXION" type="submit"></a>
                            </p>
                        </form>
                    
                    </section>
                    
                </div>
                </main>	
                
            </section>															<!-- fin phrasing -->
    
            <section id="end">															<!-- début footer -->
            
                <footer>
                
                    <p>
                    <a>MENTIONS LÉGALES</a>
                    <a href="contact.html" target="_self">CONTACT</a>
                    <a>&copy TEAM SEVEN</a>
                    </p>
                    
                </footer>		
            
            </section>															<!-- fin footer -->	
            
        </section>																<!-- fin corps -->	
        
    </body>
    
    
    </html>';

}