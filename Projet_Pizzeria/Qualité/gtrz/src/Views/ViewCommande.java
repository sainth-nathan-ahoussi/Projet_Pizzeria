package Views;

import javax.swing.*;
import java.awt.*;
import java.sql.*;

import Models.*;
import co.ConnexionBD;
import Controllers.*;

public class ViewCommande extends JPanel {
	/******************
	 ** ATTRIBUTS **
	 ******************/
	private ModelCommande sonModelCommande;
	private JPanel panelDetailsCommande = new JPanel();
	
	/**********************
	 ** CONSTRUCTEUR **
	 **********************/
	 public ViewCommande() {
		 setLayout(new BorderLayout());
	     panelDetailsCommande.setLayout(new BoxLayout(panelDetailsCommande, BoxLayout.Y_AXIS));
	     panelDetailsCommande.setBorder(BorderFactory.createLineBorder(Color.BLACK, 1));

	     JScrollPane scrollPane = new JScrollPane(panelDetailsCommande);
	     scrollPane.setVerticalScrollBarPolicy(JScrollPane.VERTICAL_SCROLLBAR_ALWAYS);
	     scrollPane.setHorizontalScrollBarPolicy(JScrollPane.HORIZONTAL_SCROLLBAR_NEVER);

	     add(scrollPane, BorderLayout.CENTER);
	 }

	/******************
	 ** METHODES **
	 ******************/
	 public void afficherVueDetailsCommande(String idPizza) {
	        panelDetailsCommande.setBackground(Color.WHITE);
	        panelDetailsCommande.removeAll();

	        Connection connection = null;
	        try {
	            connection = ConnexionBD.getConnection();
	            String requeteDetailsCommande = "SELECT ingredient.nomIngredient " +
	                    "FROM ingredient " +
	                    "NATURAL JOIN contient " +
	                    "NATURAL JOIN recette " +
	                    "NATURAL JOIN pizza " +
	                    "WHERE pizza.idPizza=" + idPizza + ";";

	            ResultSet resultSet = ConnexionBD.exec1Requete(requeteDetailsCommande, connection, 0);

	            try {
	                while (resultSet.next()) {
	                    String nomIngredient = resultSet.getString("nomIngredient");
	                    JLabel ingredientLabel = new JLabel(nomIngredient);
	                    panelDetailsCommande.add(ingredientLabel);
	                    panelDetailsCommande.add(Box.createRigidArea(new Dimension(0, 10)));
	                }
	            } catch (SQLException e) {
	                e.printStackTrace();
	            } finally {
	            	ConnexionBD.closeConnection(connection);
	            }
	        } catch (SQLException e) {
	            e.printStackTrace();
	        }

	        // Rafraîchir le panneau des détails de la commande
	        panelDetailsCommande.revalidate();
	        panelDetailsCommande.repaint();
	 }

	 public JPanel getPanelDetailsCommande() {
		 return panelDetailsCommande;
	 }
	 
}
