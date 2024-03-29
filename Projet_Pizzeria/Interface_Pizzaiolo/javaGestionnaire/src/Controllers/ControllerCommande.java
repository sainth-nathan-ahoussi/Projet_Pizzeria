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
	private int idPizzaSelectionne;
	
	/**********************
	 ** CONSTRUCTEUR **
	 **********************/

	/******************
	 ** METHODES **
	 ******************/
	public void afficherDetailsCommande(int idPizza) {
        this.idPizzaSelectionne = idPizza;
        this.sonModelCommande = new ModelCommande();
		this.saVueCommande = new ViewCommande();
        detailsVueCommande();
    }
	
    private void detailsVueCommande() {
    	saVueCommande.afficherCommande(idPizzaSelectionne);
    }
}
