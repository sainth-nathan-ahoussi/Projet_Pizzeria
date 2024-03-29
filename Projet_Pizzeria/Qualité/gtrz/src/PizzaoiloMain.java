import javax.swing.*; 
import java.awt.*;
import java.awt.event.*;
import java.sql.*;
import java.text.*;
import java.util.*;

import co.ConnexionBD;
import Models.*;
import Views.*;
import Controllers.*;

public class PizzaoiloMain {
    private JFrame bienvenueFrame;
    private JFrame ListePizzasFrame;
    private JButton terminerPizza;
    private JLabel titreLabel;

    public static void main(String[] args) {
        SwingUtilities.invokeLater(new Runnable() {
            public void run() {
            	PizzaoiloMain pizzaioloMain = new PizzaoiloMain();
                pizzaioloMain.initialiseFenetreBienvenue();
            }
        });
    }

    public void initialiseFenetreBienvenue() {
        bienvenueFrame = new JFrame("Pizzaiolo de PizzaIUT");
        bienvenueFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        bienvenueFrame.setSize(400, 250);
        bienvenueFrame.setLayout(new BorderLayout());
        bienvenueFrame.setLayout(new FlowLayout(FlowLayout.CENTER, 10, 10));
        bienvenueFrame.setIconImage(Toolkit.getDefaultToolkit().getImage(getClass().getResource("/img/LogoCorner.png")));

        JLabel bienvenueLabel = new JLabel();
        bienvenueLabel.setText("<html> <body> Bienvenue sur l'interface <p><b>" + "</b><p>du pizzaiolo de PizzaIUT !</body></html>");
        bienvenueLabel.setFont(new Font("Georgia", Font.BOLD, 18));
        bienvenueLabel.setHorizontalAlignment(SwingConstants.CENTER);
        bienvenueLabel.setForeground(Color.BLACK);

        JButton commencerButton = new JButton("Commencer");
        commencerButton.setPreferredSize(new Dimension(200, 50));
        commencerButton.setBackground(new Color(0xa52a2a));
        commencerButton.setForeground(Color.WHITE);
        commencerButton.setBorder(BorderFactory.createEmptyBorder());
        commencerButton.setFont(new Font("Calibri", Font.BOLD, 16));
        commencerButton.setFocusPainted(false);

        commencerButton.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                bienvenueFrame.dispose();
                initialize();
            }
        });

        commencerButton.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseEntered(java.awt.event.MouseEvent evt) {
                commencerButton.setBackground(new Color(0x6e0101));
            }

            public void mouseExited(java.awt.event.MouseEvent evt) {
                commencerButton.setBackground(new Color(0xa52a2a));
            }
        });

        JPanel bienvenuePanel = new JPanel();
        JPanel boutonPanel = new JPanel();
        bienvenuePanel.setLayout(new FlowLayout(FlowLayout.CENTER));
        boutonPanel.setLayout(new FlowLayout(FlowLayout.CENTER));
        bienvenuePanel.setBorder(BorderFactory.createEmptyBorder(20, 20, 20, 20));
        bienvenuePanel.add(bienvenueLabel);
        boutonPanel.add(commencerButton);

        bienvenueFrame.add(bienvenuePanel);
        bienvenueFrame.add(boutonPanel);
        bienvenueFrame.setVisible(true);
    }

    public void initialize() {
        ListePizzasFrame = new JFrame("Pizzaiolo - PizzaIUT");
        ListePizzasFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        ListePizzasFrame.setSize(800, 600);
        ListePizzasFrame.setLayout(new BorderLayout());
        ListePizzasFrame.setIconImage(Toolkit.getDefaultToolkit().getImage(getClass().getResource("/images/logo.png")));

        ControllerCommande ControllerCommande = new ControllerCommande();
        ViewCommande ViewCommande = new ViewCommande();
        ViewListeCommande vueListeCommande = new ViewListeCommande(ControllerCommande, ViewCommande);

        vueListeCommande.setVueDetailsCommande(ViewCommande);
        vueListeCommande.afficherCommande();

        JPanel listeCommandePanel = vueListeCommande.getPnlListeCommande();
        ListePizzasFrame.add(vueListeCommande.getPnlTop(), BorderLayout.NORTH);

        JPanel listeIngredientPanel = ViewCommande.getPanelDetailsCommande();

        // Utilisation d'un JSplitPane pour diviser la fenêtre
        JSplitPane splitPane = new JSplitPane(JSplitPane.HORIZONTAL_SPLIT);
        splitPane.setLeftComponent(listeCommandePanel);
        splitPane.setRightComponent(listeIngredientPanel);
        splitPane.setDividerLocation(200); // Réglez la position initiale du séparateur

        ListePizzasFrame.add(splitPane, BorderLayout.CENTER);

        ListePizzasFrame.setVisible(true);
    }

}
