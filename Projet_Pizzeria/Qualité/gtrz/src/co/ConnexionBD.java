package co;

import java.sql.*;

public class ConnexionBD {
	public static Connection openConnection (String url) { //Pour se connecter
		Connection co=null;
		try {
			Class.forName("com.mysql.cj.jdbc.Driver");
			co= DriverManager.getConnection(url);
		} catch (ClassNotFoundException e) {
			System.out.println("il manque le driver oracle");
			System.exit(1);
		} catch (SQLException e) {
			System.out.println("impossible de se connecter à l'url : " + url);
			System.exit(1);
		}
		return co;
	}
	
	private static final String lien = "jdbc:mysql://192.70.36.54:3306/saes3-cdarown";
	private static final String identifiant = "saes3-cdarown";
    private static final String mdp = "ExhlH6r5uBw1/8J5";
    
    public static Connection getConnection() throws SQLException { // Pour partager la connexion aux autres fichiers
        return DriverManager.getConnection(lien, identifiant, mdp);
    }
    
	public static ResultSet exec1Requete (String requete, Connection co, int type) { // Pour executer des requetes
		ResultSet res=null;
		try {
			Statement st;
			if (type==0){
				st=co.createStatement();
			} else {
				st=co.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_READ_ONLY);
			}
			res= st.executeQuery(requete);
		} catch (SQLException e) {
			System.out.println("Problème lors de l'exécution de la requete : "+requete);
		}
		return res;
	}
	
	public static void closeConnection(Connection co) { //Pour fermer la connexion
		try {
			co.close();
			System.out.println("Connexion fermée!");
		} catch (SQLException e) {
			System.out.println("Impossible de fermer la connexion");
		}
	}
}