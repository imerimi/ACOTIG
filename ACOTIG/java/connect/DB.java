//package data_struc;
import java.sql.*;
import java.io.FileWriter;
import java.io.PrintWriter;
import java.io.IOException;
import java.util.ArrayList;

class DB{
		//Connection con= null;
		private static Connection con;
		private static ResultSet rs;
		private static Statement st;
		private static ResultSet rs1;
		private static Statement st1;
		public int group_num;
		public ArrayList group= new ArrayList();

		// public String db= "fyp";
		// public String url = "jdbc:mysql://localhost/fyp?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC";
		// public String user = "root";
		// public String pwd= "";
	public DB() {
		try{
			String db= "acotig";
			String url = "jdbc:mysql://localhost/acotig?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC";
			String user = "root";
			String pwd= "";
			Class.forName("com.mysql.jdbc.Driver");
			con=DriverManager.getConnection(url,user,pwd);
			st=con.createStatement();
			System.out.println("Connected to... "+ db);
		}
		catch(Exception e){
			System.out.println(e.getMessage());
		}
	}
	
		public void getRoomData(){
			try{
			//PrintWriter writer = new PrintWriter("the-file-name.txt", "UTF-8");
			 String query="SELECT r.code, r.roomtype_fk, rt.capacity from room r join roomtype rt on r.roomtype_fk=rt.name";
			 rs=st.executeQuery(query);
			FileWriter writer = new FileWriter("room.txt", false); //overwrite
			while(rs.next()){
				String code= rs.getString("r.code");
				writer.write(code);
				writer.write("\n");
				String roomtype= rs.getString("r.roomtype_fk");
				writer.write(roomtype);
				writer.write("\n");
				String capacity= rs.getString("rt.capacity");
				writer.write(capacity);
				//System.out.println("code;"+code+"type"+type);
				writer.write("\n");
			}
            writer.close();
			}
			catch(Exception ex){
				System.out.print(ex);
			}
		}
		
		public void getLecturerData(){
			try{
			//PrintWriter writer = new PrintWriter("the-file-name.txt", "UTF-8");
			 String query="SELECT id, name from lecturer";
			 rs=st.executeQuery(query);
			FileWriter writer = new FileWriter("lecturer.txt", false); //overwrite
			while(rs.next()){
				String id= rs.getString("id");
				writer.write(id);
				writer.write("\n");
				String name= rs.getString("name");
				writer.write(name);
				//System.out.println("code;"+code+"type"+type);
				writer.write("\n");
			}
            writer.close();
			}
			catch(Exception ex){
				System.out.print(ex);
			}
		}
		
		public void getGroupData(){
			// int group_num=0;
			try{
			//PrintWriter writer = new PrintWriter("the-file-name.txt", "UTF-8");
			 String query="SELECT COUNT(*) as count from grouping";
			 rs=st.executeQuery(query);
			// System.out.println(rs.getInt("count"));
			 while (rs.next()) {
				 group_num=rs.getInt(1);
			}
			for(int i=0;i<group_num;i++){
				//try{
					FileWriter writer = new FileWriter("g"+i+".txt", false);
					//writer.write("Yes");
				writer.close();
				//catch(Exception e1){System.out.print(e1);};
			}
			}catch(Exception ex){
				System.out.print(ex);
			}
		}
		
		
		public void getGroupData2(){
			try{
			//PrintWriter writer = new PrintWriter("the-file-name.txt", "UTF-8");
			 String query="SELECT * from grouping";
			 rs=st.executeQuery(query);
			FileWriter writer = new FileWriter("grouping.txt", false); //overwrite
			while(rs.next()){
				String id= rs.getString("id");
				group.add(id);
				//System.out.println(group.get(0));
				writer.write(id);
				writer.write("\n");
				String desc= rs.getString("description");
				writer.write(desc);
				writer.write("\n");
			}
            writer.close();
			}
			catch(Exception ex){
				System.out.print(ex);
			}
		}
		
		public void getSubjectData(){
			try{
			//PrintWriter writer = new PrintWriter("the-file-name.txt", "UTF-8");
			 String query="SELECT * from subject";
			 rs=st.executeQuery(query);
			FileWriter writer = new FileWriter("subject.txt", false); //overwrite
			while(rs.next()){
				String code= rs.getString("code");
				writer.write(code);
				writer.write("\n");
				String title= rs.getString("title");
				writer.write(title);
				writer.write("\n");
			}
            writer.close();
			}
			catch(Exception ex){
				System.out.print(ex);
			}
		}
		
		public void getClassData3(){
			try{
			 String query="SELECT * from class order by grouping_fk";
			 rs=st.executeQuery(query);
			FileWriter writer = new FileWriter("class.txt", false); //overwrite
			while(rs.next()){
				String id= rs.getString("id");
				writer.write(id);
				writer.write("\n");
				String name= rs.getString("subject_fk");
				writer.write(name);
				writer.write("\n");
				String section= rs.getString("section");
				writer.write(section);
				writer.write("\n");
				String roomtype= rs.getString("roomtype_fk");
				writer.write(roomtype);
				writer.write("\n");
				String lecturer= rs.getString("lecturer_fk");
				writer.write(lecturer);
				writer.write("\n");
				String grouping= rs.getString("grouping_fk");
				writer.write(grouping);
				writer.write("\n");
				
				}
				writer.close();
			}
			catch(Exception ex){
				System.out.print(ex);
			}
		}
		
		public void getClassData(){
			try{
			//PrintWriter writer = new PrintWriter("the-file-name.txt", "UTF-8");
			 String query="SELECT * from class";
			 rs=st.executeQuery(query);
			//FileWriter writer = new FileWriter("class.txt", false); //overwrite
			while(rs.next()){
				String id= rs.getString("id");
				//writer.write(id);
				//writer.write("\n");
				String name= rs.getString("subject_fk");
				//writer.write(name);
				//writer.write("-");
				String section= rs.getString("section");
				//writer.write(section);
				//writer.write("\n");
				String roomtype= rs.getString("roomtype_fk");
				//writer.write(roomtype);
				//writer.write("\n");
				String lecturer= rs.getString("lecturer_fk");
				//writer.write(lecturer);
				//writer.write("\n");
				String grouping= rs.getString("grouping_fk");
				//writer.write(grouping);
				//writer.write("\n");
				for(int i=0;i<group.size();i++){
					if (grouping.equals(group.get(0))){
						FileWriter writer = new FileWriter("g"+i+".txt", true);
						writer.write(id);
						writer.write("\n");
						writer.write(name);
						writer.write("-");
						writer.write(section);
						writer.write("\n");
						writer.write(roomtype);
						writer.write("\n");
						writer.write(lecturer);
						writer.write("\n");
						writer.write(grouping);
						writer.write("\n");
						//i=group.size();
						writer.close();
					}
				}
			}
			}
			catch(Exception ex){
				System.out.print(ex);
			}
		}
	
	public static void main(String[] args){
		DB test= new DB();
		test.getRoomData();
		test.getLecturerData();
		//test.getGroupData();
		test.getGroupData2();
		test.getClassData3();
		test.getSubjectData();
		//test.getClassData();
	}
		
}




//javac -cp mysql-connector-java-8.0.19.jar;. DB.java
//java -cp mysql-connector-java-8.0.19.jar;. DB