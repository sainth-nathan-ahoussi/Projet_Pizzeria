package Views;

import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.sql.*;

import Models.*;
import co.ConnexionBD;
import Controllers.*;

public class ViewListeCommande extends JPanel {
	/******************
	 ** ATTRIBUTS **
	 ******************/
    private ModelListeCommande sonModelListeCommande;
    private JPanel pnlListeCommande = new JPanel();
    private JLabel lblTop = new JLabel();
    private JPanel pnlTop = new JPanel();
    private ControllerCommande sonControllerCommande;
    private ViewCommande saViewCommande;

    /**********************
	 ** CONSTRUCTEUR **
	 **********************/
    public ViewListeCommande(ControllerCommande ctrlComm, ViewCommande vueComm) {
        this.sonControllerCommande = ctrlComm;
        this.saViewCommande = vueComm;
        setLayout(new BorderLayout());
        pnlListeCommande.setLayout(new BoxLayout(pnlListeCommande, BoxLayout.Y_AXIS));
        pnlListeCommande.setBorder(BorderFactory.createLineBorder(Color.white, 2));
        lblTop.setText("Pizzas à préparer : ");
        
        JScrollPane scrollPane = new JScrollPane(pnlListeCommande);
        scrollPane.setVerticalScrollBarPolicy(JScrollPane.VERTICAL_SCROLLBAR_ALWAYS);
        scrollPane.setHorizontalScrollBarPolicy(JScrollPane.HORIZONTAL_SCROLLBAR_NEVER);

        add(scrollPane, BorderLayout.CENTER);
    }

    /******************
	 ** METHODES **
	 ******************/
    public void afficherCommande() {
        pnlTop.setBackground(new Color(30, 30, 30));
        pnlListeCommande.setBackground(new Color(30, 30, 30));
        pnlTop.setBorder(BorderFactory.createEmptyBorder(10, 10, 10, 10));
        pnlTop.setLayout(new BorderLayout());

        lblTop.setFont(new Font("Serif", Font.BOLD, 30));
        lblTop.setForeground(new Color(242, 72, 34));
        pnlTop.add(lblTop);

        Connection maCo;
        try {
            maCo = ConnexionBD.getConnection();
            String requetePizza = "SELECT c.ID_Commande, pf.ID_PizzaFinale, pf.DescriptionPizzaFinale, rc.ID_Pizza FROM Commande c\r\n"
            		+ "JOIN Ligne_Commande lc ON lc.ID_Commande = c.ID_Commande\r\n"
            		+ "JOIN PizzaFinale pf ON pf.ID_PizzaFinale = lc.ID_PizzaFinale\r\n"
            		+ "JOIN RecettePizza rc ON rc.ID_Pizza = pf.ID_Pizza \r\n"
            		+ "WHERE lc.StatutLC = 'En cours'\r\n"
            		+ "ORDER BY c.HeureCommande ";

            ResultSet resultSet = ConnexionBD.exec1Requete(requetePizza, maCo, 1);
            try {
                while (resultSet.next()) {
                	int idCommande = resultSet.getInt("ID_Commande");
                    int idPizzaFinale = resultSet.getInt("ID_PizzaFinale");
                    String descPizzaFinale = resultSet.getString("DescriptionPizzaFinale");

                    JButton btnCommande = new JButton("Commande " + idCommande + " : " + descPizzaFinale);
                    btnCommande.setBackground(Color.black);
                    btnCommande.setForeground(Color.white);
                    btnCommande.setBorder(BorderFactory.createLineBorder(new Color(242, 72, 34), 1));
                    btnCommande.setFont(new Font("Serif", Font.BOLD, 12));
                    btnCommande.setMaximumSize(new Dimension(Integer.MAX_VALUE, btnCommande.getPreferredSize().height));
                    
                    btnCommande.addActionListener(new ActionListener() {
                        public void actionPerformed(ActionEvent e) {
                            sonControllerCommande.afficherDetailsCommande(idPizzaFinale);
                            // Changer la couleur du bouton lorsqu'il est cliqué
                            btnCommande.setBackground(new Color(242, 72, 34));
                            btnCommande.setForeground(Color.white);
                            // Afficher les détails de la commande dans ViewCommande
                            lblTop.setText("Pizza actuelle : " + descPizzaFinale);
                            saViewCommande.afficherCommande(idPizzaFinale);
                        }
                    });

                    btnCommande.addMouseListener(new java.awt.event.MouseAdapter() {
                        public void mouseEntered(java.awt.event.MouseEvent evt) {
                            btnCommande.setForeground(new Color(242, 72, 34));
                        }
                        public void mouseExited(java.awt.event.MouseEvent evt) {
                            btnCommande.setBackground(Color.black);
                            btnCommande.setForeground(Color.white);
                        }
                    });

                    pnlListeCommande.add(btnCommande);
                    pnlListeCommande.add(Box.createRigidArea(new Dimension(0, 8)));
                }
            } catch (SQLException e) {
                e.printStackTrace();
            } finally {
                ConnexionBD.closeConnection(maCo);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }

        pnlListeCommande.revalidate();
        pnlListeCommande.repaint();
    }
    
    public void refreshCommande() {
    	pnlListeCommande.removeAll();
    	afficherCommande();
    }
    
    public void setVueCommande(ViewCommande vueComm) {
        this.saViewCommande = vueComm;
    }

    public JPanel getPnlTop() {
        return pnlTop;
    }
    public JPanel getPnlListeCommande() {
        return pnlListeCommande;
    }
}
