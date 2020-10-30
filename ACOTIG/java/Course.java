import java.util.*;
import java.util.ArrayList;

public class Course{
	private String code= null;
	private String title= null;
	private String section= null;
	private ArrayList<Room> room;
	private ArrayList<Lecturer> lecturer;
	
	public Course(String code,String title,String section, ArrayList<Room> room,ArrayList<Lecturer> lecturer){
		this.code= code;
		this.title=title;
		this.section=section;
		this.room = room;
		this.lecturer =lecturer; 
	}
	
	public String getCode(){
		return code;
	}
	
	public String getTitle(){
		return title;
	}
	
	public String getSection(){
		return section;
	}
	
	public ArrayList<Lecturer> getLecturer(){
		return lecturer;
	}
	
	public ArrayList<Room> getRoom(){
		return room;
	}
}
