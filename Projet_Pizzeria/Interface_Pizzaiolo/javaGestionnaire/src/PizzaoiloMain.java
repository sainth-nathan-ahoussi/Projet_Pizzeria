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
import java.util.concurrent.*;

public class PizzaoiloMain {
    private JFrame bienvenueFrame;
    private JFrame ListePizzasFrame;
    private JButton terminerPizza;
    private JLabel titreLabel;
    private static ControllerCommande sonControllerCommande = new ControllerCommande();
    private static ViewCommande saVueCommande = new ViewCommande();
    private static ViewListeCommande saVueListeCommande = new ViewListeCommande(sonControllerCommande, saVueCommande);
    
    public void initialiseFenetreBienvenue() {
        bienvenueFrame = new JFrame("AltaMama Pizzaiolo");
        bienvenueFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        bienvenueFrame.setSize(400, 250);
        bienvenueFrame.setLayout(new BorderLayout());
        bienvenueFrame.setLayout(new FlowLayout(FlowLayout.CENTER, 10, 10));
        bienvenueFrame.setIconImage(Toolkit.getDefaultToolkit().getImage(getClass().getResource("/img/LogoCorner.png")));
        bienvenueFrame.setBackground(new Color(30, 30, 30));

        JLabel bienvenueLabel = new JLabel();
        bienvenueLabel.setText("<html> <body> Salut bg, travaille <p><b>" + "</b><p> bien aujourd'hui!</body></html>");
        bienvenueLabel.setFont(new Font("Serif", Font.BOLD, 18));
        bienvenueLabel.setHorizontalAlignment(SwingConstants.CENTER);
        bienvenueLabel.setForeground(Color.BLACK);
        bienvenueLabel.setBackground(new Color(30, 30, 30));

        JButton commencerButton = new JButton("Commencer");
        commencerButton.setPreferredSize(new Dimension(200, 50));
        commencerButton.setBackground(new Color(242, 72, 34));
        commencerButton.setForeground(Color.WHITE);
        commencerButton.setBorder(BorderFactory.createEmptyBorder());
        commencerButton.setFont(new Font("Serif", Font.BOLD, 18));
        commencerButton.setFocusPainted(false);

        commencerButton.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                bienvenueFrame.dispose();
                initialize();
            }
        });

        commencerButton.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseEntered(java.awt.event.MouseEvent evt) {
                commencerButton.setBackground(new Color(30, 30, 30));
            }

            public void mouseExited(java.awt.event.MouseEvent evt) {
                commencerButton.setBackground(new Color(242, 72, 34));
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
        ListePizzasFrame = new JFrame("AltaMama Pizzaiolo");
        ListePizzasFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        ListePizzasFrame.setSize(800, 600);
        ListePizzasFrame.setLayout(new BorderLayout());
        ListePizzasFrame.setIconImage(Toolkit.getDefaultToolkit().getImage(getClass().getResource("/img/LogoCorner.png")));

        saVueListeCommande.setVueCommande(saVueCommande);
        saVueListeCommande.afficherCommande();

        JPanel listeCommandePanel = saVueListeCommande.getPnlListeCommande();
        ListePizzasFrame.add(saVueListeCommande.getPnlTop(), BorderLayout.NORTH);

        JPanel listeIngredientPanel = saVueCommande.getPanelDetailsCommande();

        // Utilisation d'un JSplitPane pour diviser la fenêtre
        JSplitPane splitPane = new JSplitPane(JSplitPane.HORIZONTAL_SPLIT);
        splitPane.setLeftComponent(listeCommandePanel);
        splitPane.setRightComponent(listeIngredientPanel);
        splitPane.setDividerLocation(200); // Réglez la position initiale du séparateur
        
        ListePizzasFrame.add(splitPane, BorderLayout.CENTER);

        ListePizzasFrame.setVisible(true);
    }
    
    public static void main(String[] args) {
        SwingUtilities.invokeLater(new Runnable() {
            public void run() {
            	PizzaoiloMain pizzaioloMain = new PizzaoiloMain();
                pizzaioloMain.initialiseFenetreBienvenue();
            }
        });
        ScheduledExecutorService scheduler = Executors.newScheduledThreadPool(1);
        // Démarrez la tâche avec une période de 5 secondes
        scheduler.scheduleWithFixedDelay(() -> {
            // Appeler votre fonction ici
        	saVueListeCommande.refreshCommande();
        }, 10, 5, TimeUnit.SECONDS);
    }

}
