<?php
#**********************************************************************************#

				
				/**
				*
				*	Entschärft und säubert einen String, falls er einen Wert besitzt
				*	Falls der String keinen Wert besitzt (NULL, "", 0, false) wird er 
				*	1:1 zurückgegeben
				*
				*	@param String $value - Der zu entschärfende und zu bereinigende String
				*
				*	@return String 				- Originalwert oder der entschärfte und bereinigte String
				*
				*/
				function cleanString($value) {
//if(DEBUG_F)		echo "<p class='debugCleanString'><b>Line " . __LINE__ . "</b>: Aufruf " . __FUNCTION__ . "('$value') <i>(" . basename(__FILE__) . ")</i></p>\r\n";	
					
					// htmlspecialchars() entschärft HTML-Steuerzeichen wie < > & ""
					// und ersetzt sie durch &lt;, &gt;, &amp;, &quot;
					// ENT_QUOTES | ENT_HTML5 ersetzt zusätzlich '' durch &apos;
					$value = htmlspecialchars( $value, ENT_QUOTES | ENT_HTML5 );
										
					// trim() entfernt am Anfang und am Ende eines Strings alle 
					// sog. Whitespaces (Leerzeichen, Tabulatoren, Zeilenumbrüche)
					$value = trim( $value );
					
					// Um später in der DB keine NULL-Werte mit Leerstrings zu überschreiben, 
					// werden hier Leerstrings zentral in echte NULL-Werte umgewandelt
					if( $value === "" ) {
						$value = NULL;
					}
					
					return $value;
				}


#**********************************************************************************#

				
				/**
				*
				*	Prüft einen String auf Leerstring, Mindest- und Maxmimallänge
				*
				*	@param String $value 									- Der zu prüfende String
				*	@param [Integer $minLength=MIN_INPUT_LENGTH] 	- Die erforderliche Mindestlänge
				*	@param [Integer $maxLength=MAX_INPUT_LENGTH] 	- Die erlaubte Maximallänge
				*
				*	@return String/NULL - Ein String bei Fehler, ansonsten NULL
				*	
				*/
				function checkInputString($value, $minLength=MIN_INPUT_LENGTH, $maxLength=MAX_INPUT_LENGTH) {
//if(DEBUG_F)		echo "<p class='debugCheckInputString'><b>Line " . __LINE__ . "</b>: Aufruf " . __FUNCTION__ . "('$value [$minLength | $maxLength]') <i>(" . basename(__FILE__) . ")</i></p>\r\n";					
					
					$errorMessage = NULL;
					
					// Prüfen auf leeres Feld/Prüfen auf Leerstring
					if( !$value ) {
						// Fehlermeldung generieren
						$errorMessage = "Dies ist ein Pflichtfeld!";
						
					// Prüfen auf Mindestlänge	
					} elseif( mb_strlen($value) < $minLength ) {	
						// Fehlermeldung generieren
						$errorMessage = "Muss mindestens $minLength Zeichen lang sein!";
						
					// Prüfen auf Maximallänge	
					} elseif( mb_strlen($value) > $maxLength ) {
						// Fehlermeldung generieren
						$errorMessage = "Darf maximal $maxLength Zeichen lang sein!";
					}	
					
					// Fehlermeldung zurückgeben
					return $errorMessage;
					
				}


				



#**********************************************************************************#
?>


















