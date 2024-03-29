package Controllers;

import javax.swing.*;
import java.awt.*;
import java.util.*;

import Models.*;
import Views.*;

public class ControllerListeCommande {
	/******************
	 ** ATTRIBUTS **
	 ******************/
	private ModelListeCommande sonModelListeCommande;
	private ViewListeCommande saVueListeCommande;
	
	/**********************
	 ** CONSTRUCTEUR **
	 **********************/
	public ControllerListeCommande(ModelListeCommande model, ViewListeCommande view) {
        this.sonModelListeCommande = model;
        this.saVueListeCommande = view;
    }

	/******************
	 ** METHODES **
	 ******************/

}
