package Controllers;

import javax.swing.*;
import java.awt.*;
import Models.*;
import Views.*;

public class ControllerCommande {
	/******************
	 ** ATTRIBUTS **
	 ******************/
	private ModelCommande sonModelCommande;
	private ViewCommande saVueCommande;
	private String idPizzaSelectionne;
	
	/**********************
	 ** CONSTRUCTEUR **
	 **********************/
	

	/******************
	 ** METHODES **
	 ******************/
	public void afficherDetailsCommande(String idPizza) {
        this.idPizzaSelectionne = idPizza;
        if (saVueCommande == null) {
        	saVueCommande = new ViewCommande();
        }
        afficherDetailsDansVueDetailsCommande();
    }


    private void afficherDetailsDansVueDetailsCommande() {
    	saVueCommande.afficherVueDetailsCommande(idPizzaSelectionne);
    }
}
