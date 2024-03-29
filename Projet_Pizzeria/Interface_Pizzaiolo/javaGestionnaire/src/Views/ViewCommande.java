package Views;

import javax.swing.*;
import javax.swing.border.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.*;

import Models.*;
import co.ConnexionBD;
import Controllers.*;

public class ViewCommande extends JPanel {
	/******************
	 ** ATTRIBUTS **
	 ******************/
	private ModelCommande sonModelCommande;
	private JPanel pnlCommande = new JPanel();
	private boolean test = false;

	/**********************
	 ** CONSTRUCTEUR **
	 **********************/
	public ViewCommande() {
		setLayout(new BorderLayout());
		pnlCommande.setLayout(new BoxLayout(pnlCommande, BoxLayout.Y_AXIS));
		pnlCommande.setBorder(BorderFactory.createLineBorder(Color.BLACK, 1));
		 
	    JScrollPane scrollPane = new JScrollPane(pnlCommande);
	    scrollPane.setVerticalScrollBarPolicy(JScrollPane.VERTICAL_SCROLLBAR_ALWAYS);
	    scrollPane.setHorizontalScrollBarPolicy(JScrollPane.HORIZONTAL_SCROLLBAR_NEVER);

	    add(scrollPane, BorderLayout.CENTER);
	}

	/******************
	 ** METHODES **
	 ******************/
	public void afficherCommande(int idPizza) {
		JButton sonBouton = new JButton("Préparation fini");
		sonBouton.setBackground(Color.black);
		sonBouton.setForeground(Color.white);
        sonBouton.setBorder(BorderFactory.createLineBorder(new Color(242, 72, 34), 1));
        sonBouton.setFont(new Font("Serif", Font.BOLD, 12));
        sonBouton.setMaximumSize(new Dimension(sonBouton.getPreferredSize().width+20, sonBouton.getPreferredSize().height));

		pnlCommande.setBackground(Color.WHITE);
		pnlCommande.removeAll();

	    Connection maCo;
	    try {
	    	maCo = ConnexionBD.getConnection();
	    	String rqIngre = "SELECT lc.ID_LigneCommande, i.NomIngredient FROM Ingredient i \r\n"
	    			+ "JOIN utilise u ON u.ID_Ingredient=i.ID_Ingredient \r\n"
	    	 		+ "JOIN RecettePizza rc ON rc.ID_Pizza=u.ID_Pizza \r\n"
	    	 		+ "JOIN PizzaFinale pf ON pf.ID_Pizza=rc.ID_Pizza \r\n"
	    	 		+ "JOIN Ligne_Commande lc ON lc.ID_PizzaFinale=pf.ID_PizzaFinale \r\n"
	    	 		+ "WHERE pf.ID_PizzaFinale = " + idPizza + ";";
	            
	    	String rqSupp = "SELECT sp.NomSupplementPizza FROM SupplementPizza sp \r\n"
	            	+ "JOIN modifie m ON m.ID_SupplementPizza = sp.ID_SupplementPizza \r\n"
	            	+ "JOIN PizzaFinale pf ON pf.ID_PizzaFinale = m.ID_PizzaFinale \r\n"
	            	+ "WHERE pf.ID_PizzaFinale = " + idPizza + ";";
	         
	        ResultSet rsIngre = ConnexionBD.exec1Requete(rqIngre, maCo, 0);
	        ResultSet rsSupp = ConnexionBD.exec1Requete(rqSupp, maCo, 0);
	        try {
	        	while (rsIngre.next()) {
	        		String nomIngredient = rsIngre.getString("NomIngredient");
	        		JLabel lblIngre = new JLabel(nomIngredient);
	        		pnlCommande.add(lblIngre);
	        		pnlCommande.add(Box.createRigidArea(new Dimension(5, 10)));
	                
	        		String idLc = rsIngre.getString("ID_LigneCommande");
		        	sonBouton.addActionListener(new ActionListener() {
		        		public void actionPerformed(ActionEvent e) {
	                     	effacerCommande(idLc);
	                         // Changer la couleur du bouton lorsqu'il est cliqué
	                     	sonBouton.setBackground(new Color(242, 72, 34));
	                     	sonBouton.setForeground(Color.white);
	                     }
		        	});
		        	sonBouton.addMouseListener(new java.awt.event.MouseAdapter() {
	                    public void mouseEntered(java.awt.event.MouseEvent evt) {
	                    	sonBouton.setForeground(new Color(242, 72, 34));
	                    }
	                    public void mouseExited(java.awt.event.MouseEvent evt) {
	                    	sonBouton.setBackground(Color.black);
	                    	sonBouton.setForeground(Color.white);
	                    }
	                });
	            }
	            if(rsSupp != null) {
	            	while (rsSupp.next()) {
	            		String nomSupplement = rsSupp.getString("NomSupplementPizza");
		                JLabel lblSupp = new JLabel(nomSupplement);
		                pnlCommande.add(lblSupp);
		                pnlCommande.add(Box.createRigidArea(new Dimension(0, 10)));
		            }
	             }
	             pnlCommande.add(sonBouton);
	         } catch (SQLException e) {
	        	 e.printStackTrace();
	         }
	     } catch (SQLException e) {
	    	 e.printStackTrace();
	     }

	     // Rafraîchir le panneau des détails de la commande
	     pnlCommande.revalidate();
	     pnlCommande.repaint();
	 }
	 
	 public void effacerCommande(String idLc) {
		 if (test == false) {
			 Connection maCo = null;
			 Statement stm = null;
		 	 try {
		 		 maCo = ConnexionBD.getConnection();
				 stm = maCo.createStatement();
			 } catch (SQLException e1) {
				 // TODO Auto-generated catch block
				 e1.printStackTrace();
			 }
		 	 String rqSuppr = "UPDATE Ligne_Commande SET StatutLC = 'Terminé' WHERE ID_LigneCommande = " + idLc + ";";
		 	 try {
		 		 stm.executeUpdate(rqSuppr);
		 	 } catch (SQLException e) {
		 		 // TODO Auto-generated catch block
		 		 e.printStackTrace();
		 	 }
		 	 rqSuppr = " ";
		 	 // Rafraîchir le panneau des détails de la commande
		 	 pnlCommande.setBackground(Color.WHITE);
		 	 pnlCommande.removeAll();
		 	 pnlCommande.revalidate();
		 	 pnlCommande.repaint();
	     
		 	 test = true;
		 }
	 }
	 
	 public void refresh() {
		 pnlCommande.setBackground(Color.WHITE);
		 pnlCommande.removeAll();
	 }

	 public boolean getTest() {
		 return test;
	 }
	 public JPanel getPanelDetailsCommande() {
		 return pnlCommande;
	 }
	 
}
