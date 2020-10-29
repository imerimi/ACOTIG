import java.util.*;

public class Class{
	private int id;
	private Group group;
	private Course course;
	private Lecturer lecturer;
	private Time time;
	private Room room;
	public Class(int id,Group group,Course course){
		this.id=id;
		this.group=group;
		this.course=course;
	}
	
	public void setLecturer(Lecturer lecturer){
		this.lecturer=lecturer;
	}
	
	public void setTime(Time time){
		this.time=time;
	}
	
	public void setRoom(Room room){
		this.room=room;
	}
	
	public int getId(){
		return id;
	}
	
	public Group getGroup(){
		return group;
	}
	
	public Course getCourse(){
		return course;
	}
	
	public Lecturer getLecturer(){
		return lecturer;
	}
	
	public Time getTime(){
		return time;
	}
	
	public Room getRoom(){
		return room;
	}
	
	public String toString(){
		return "["+group.getName()+","+course.getCode()+","+room.getCode()+","+lecturer.getId()+","+time.getId()+"]";
	}
}