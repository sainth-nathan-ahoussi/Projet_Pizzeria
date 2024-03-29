package Views;

import javax.swing.*;
import java.awt.*;
import java.sql.*;

import Models.*;
import co.ConnexionBD;
import Controllers.*;

public class ViewPizzaFinale extends JFrame {
	/******************
	 ** ATTRIBUTS **
	 ******************/
	private JLabel lblImage;
    private ControllerPizzaFinale sonControllerPizzaFinale = new ControllerPizzaFinale();
	private ModelPizzaFinale sonModelPizzaFinale;
	
	/**********************
	 ** CONSTRUCTEUR **
	 **********************/
	public ViewPizzaFinale(String idPizza, ControllerPizzaFinale ctrl, ModelPizzaFinale model) {
		this.sonControllerPizzaFinale = ctrl;
		this.sonModelPizzaFinale = model;
    }

	/******************
	 ** METHODES **
	 ******************/
	private void afficherPizza() {
        // Créez un JLabel pour afficher l'image
        lblImage = new JLabel();
        add(lblImage);
    }
	
	private void afficherImagePizza() {
        try {
        	Connection co = ConnexionBD.getConnection();
        	PreparedStatement preparedStatement = null;
            ResultSet resultSet = null;

            // Exécutez la requête pour obtenir le NomPizza et l'image
            String requete = "SELECT NomPizza, imagePizza FROM RecettePizza WHERE ID_Pizza = ";
            preparedStatement = co.prepareStatement(requete);
            resultSet = preparedStatement.executeQuery();

            // Vérifiez si le résultat contient des lignes
            if (resultSet.next()) {
                // Récupérez le nomRecette
                String nomPizza = resultSet.getString("NomPizza");
                
                // Récupérez les données binaires de l'image
                byte[] imageData = resultSet.getBytes("imagePizza");
                
                // Convertissez les données binaires en ImageIcon
                ImageIcon imagePizza = new ImageIcon(imageData);

                // Mettez à jour l'étiquette d'image avec l'ImageIcon
                lblImage = new JLabel(imagePizza);
                add(lblImage);

                // Affichez le nomRecette
                setTitle("Vue Pizza - " + nomPizza);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
	
}
