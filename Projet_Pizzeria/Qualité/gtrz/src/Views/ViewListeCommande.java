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
    private JButton btnCommande;

    /**********************
	 ** CONSTRUCTEUR **
	 **********************/
    public ViewListeCommande(ControllerCommande ctrlComm, ViewCommande vueComm) {
        this.sonControllerCommande = ctrlComm;
        this.saViewCommande = vueComm;
        setLayout(new BorderLayout());
        pnlListeCommande.setLayout(new BoxLayout(pnlListeCommande, BoxLayout.Y_AXIS));
        pnlListeCommande.setBorder(BorderFactory.createLineBorder(Color.white, 2));

        JScrollPane scrollPane = new JScrollPane(pnlListeCommande);
        scrollPane.setVerticalScrollBarPolicy(JScrollPane.VERTICAL_SCROLLBAR_ALWAYS);
        scrollPane.setHorizontalScrollBarPolicy(JScrollPane.HORIZONTAL_SCROLLBAR_NEVER);

        add(scrollPane, BorderLayout.CENTER);
    }

    /******************
	 ** METHODES **
	 ******************/
    public void afficherCommande() {
        pnlTop.setBackground(Color.black);
        pnlListeCommande.setBackground(Color.black);
        pnlTop.setBorder(BorderFactory.createEmptyBorder(10, 10, 10, 10));
        pnlTop.setLayout(new BorderLayout());

        lblTop = new JLabel("Pizzas à préparer : ");
        lblTop.setFont(new Font("Georgia", Font.BOLD, 24));
        pnlTop.add(lblTop);

        Connection connection;
        try {
            connection = ConnexionBD.getConnection();
            String requeteTypeCo = "SELECT c.ID_Commande, pf.ID_PizzaFinale, pf.DescriptionPizzaFinale, i.NomIngredient FROM Commande c \r\n"
                    + "JOIN Ligne_Commande lc ON lc.ID_Commande = c.ID_Commande \r\n"
                    + "JOIN PizzaFinale pf ON pf.ID_PizzaFinale = lc.ID_PizzaFinale \r\n"
                    + "JOIN RecettePizza rc ON rc.ID_Pizza = pf.ID_Pizza \r\n"
                    + "JOIN modifie m ON m.ID_PizzaFinale = pf.ID_PizzaFinale \r\n"
                    + "JOIN SupplementPizza sp ON sp.ID_SupplementPizza = m.ID_SupplementPizza \r\n"
                    + "JOIN Ingredient i ON i.ID_Ingredient = sp.ID_Ingredient \r\n"
                    + "WHERE c.StatutCommande = 'En cours' "
                    + "ORDER BY c.HeureCommande;";

            ResultSet resultSet = ConnexionBD.exec1Requete(requeteTypeCo, connection, 0);
            try {
                while (resultSet.next()) {
                    String idCommande = resultSet.getString("ID_Commande");
                    String idPizzaFinale = resultSet.getString("ID_PizzaFinale");
                    String descPizzaFinale = resultSet.getString("DescriptionPizzaFinale");
                    String ingredientSupp = resultSet.getString("Ingredient");

                    btnCommande = new JButton("Commande " + idCommande + " : " + descPizzaFinale);
                    btnCommande.setBackground(Color.black);
                    btnCommande.setForeground(Color.white);
                    btnCommande.setBorder(BorderFactory.createLineBorder(Color.decode("#f24822")));
                    btnCommande.setFont(new Font("Serif", Font.BOLD, 12));
                    btnCommande.setMaximumSize(new Dimension(Integer.MAX_VALUE, btnCommande.getPreferredSize().height));

                    btnCommande.addActionListener(new ActionListener() {
                        public void actionPerformed(ActionEvent e) {
                            // Récupérer idPizzaFinale à partir du texte du bouton
                            String idPizzaBouton = idPizzaFinale;
                            sonControllerCommande.afficherDetailsCommande(idPizzaBouton);
                            // Changer la couleur du bouton lorsqu'il est cliqué
                            btnCommande.setBackground(new Color(0xf24822));
                            btnCommande.setForeground(Color.white);
                            // Afficher les détails de la commande dans ViewCommande
                            saViewCommande.afficherVueDetailsCommande(idPizzaBouton);
                        }
                    });

                    btnCommande.addMouseListener(new java.awt.event.MouseAdapter() {
                        public void mouseEntered(java.awt.event.MouseEvent evt) {
                            btnCommande.setForeground(new Color(0xf24822));
                        }
                        public void mouseExited(java.awt.event.MouseEvent evt) {
                            btnCommande.setBackground(Color.black);
                            btnCommande.setForeground(Color.white);
                        }
                    });

                    pnlListeCommande.add(btnCommande);
                    pnlListeCommande.add(Box.createRigidArea(new Dimension(0, 10)));
                }

            } catch (SQLException e) {
                e.printStackTrace();
            } finally {
                ConnexionBD.closeConnection(connection);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }

        pnlListeCommande.revalidate();
        pnlListeCommande.repaint();
    }

    public void btnAjouterCarteClick(ActionListener ecouteur) {
        btnCommande.addActionListener(ecouteur);
    }

    public void setVueDetailsCommande(ViewCommande vueComm) {
        this.saViewCommande = vueComm;
    }

    public JPanel getPnlTop() {
        return pnlTop;
    }
    public JPanel getPnlListeCommande() {
        return pnlListeCommande;
    }
}
