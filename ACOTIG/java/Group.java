import java.util.*;
import java.util.ArrayList;

public class Group{
	private String name;
	private ArrayList<Course> course;
	public Group(String name, ArrayList<Course> course){
		this.name=name;
		this.course=course;
	}
	public String getName(){
		return name;
	}
	
	public ArrayList<Course> getCourse(){
		return course;
	}
}