import java.util.*;
import java.util.ArrayList;
import java.io.File;  
import java.io.FileNotFoundException;  
import java.util.Scanner; 
import java.util.Arrays;

public class Data{
	private ArrayList<Room> room;
	private ArrayList<Lecturer> lecturer;
	private ArrayList<Course> course;
	private ArrayList tempcourse= new ArrayList();
	private ArrayList<Group> group1;
	private ArrayList<Time> time;
	private ArrayList r = new ArrayList();
	private ArrayList all = new ArrayList();
	private ArrayList lab = new ArrayList();
	private ArrayList lec = new ArrayList();
	private ArrayList lec_theater = new ArrayList();
	private ArrayList tut = new ArrayList();
	private ArrayList lecturers = new ArrayList();
	private ArrayList courses = new ArrayList();
	private ArrayList groups = new ArrayList();
	private int classNum = 0;
	private String currentGroup;
	
	public Data() {
		initialize();
	}
	
	private Data initialize(){
		 try {
			Room room;
			File myObj = new File("connect/room.txt");
			Scanner myReader = new Scanner(myObj);
			while (myReader.hasNextLine()) {
				String name=myReader.nextLine();
				String type=myReader.nextLine();
				int capacity= Integer.parseInt(myReader.nextLine());
				room=new Room(name,type,capacity);
				if(type.equals("CLC Lecture Theater")){
					r.add(room);
					all.add(room);
				}
				else if(type.equals("Laboratory")){
					lab.add(room);
					all.add(room);
					
				}
				else if(type.equals("Lecture Room")){
					lec.add(room);
					all.add(room);
				}
				else if(type.equals("Lecture Theater")){
					lec_theater.add(room);
					all.add(room);
				}
				else if(type.equals("Tutorial Room")){
					tut.add(room);
					all.add(room);
				}
				
			}
			myReader.close();
			} catch (FileNotFoundException e) {
				System.out.println("An error occurred.");
				e.printStackTrace();
			}
		
		room = new ArrayList<Room>(all);
		
		Time time1= new Time("T1","MON 9-11");
		Time time2= new Time("T2","MON 11-1");
		Time time3= new Time("T3","MON 2-4");
		Time time4= new Time("T4","MON 4-6"); 
		Time time5= new Time("T5","TUE 9-11");
		Time time6= new Time("T6","TUE 11-1");
		Time time7= new Time("T7","TUE 2-4");
		Time time8= new Time("T8","TUE 4-6"); 
		Time time9= new Time("T9","WED 9-11");
		Time time10= new Time("T10","WED 11-1");
		Time time11= new Time("T11","WED 2-4");
		Time time12= new Time("T12","WED 4-6"); 
		Time time13= new Time("T13","THU 9-11");
		Time time14= new Time("T14","THU 11-1");
		Time time15= new Time("T15","THU 2-4");
		Time time16= new Time("T16","THU 4-6"); 
		Time time17= new Time("T17","FRI 9-11");
		Time time18= new Time("T18","FRI 11-1");
		Time time19= new Time("T19","FRI 2-4");
		Time time20= new Time("T20","FRI 4-6"); 
		time = new ArrayList<Time>(Arrays.asList(time1,time2,time3,time4,time5,time6,time7,time8,time9,time10,time11,time12,time13,time14,time15,time16,time17,time18,time19,time20));
		
		try{
		Lecturer lecturer;
			File myObj = new File("connect/lecturer.txt");
			Scanner myReader = new Scanner(myObj);
			while (myReader.hasNextLine()) {
				String id=myReader.nextLine();
				String name=myReader.nextLine();
				lecturer=new Lecturer(id,name);
				lecturers.add(lecturer)	;
			}
			myReader.close();
			} catch (FileNotFoundException e) {
				System.out.println("An error occurred.");
				e.printStackTrace();
		}
		
		lecturer = new ArrayList<Lecturer>(lecturers);
		
		
		try{
			File myObj = new File("connect/grouping.txt");
			Scanner myReader = new Scanner(myObj);
			currentGroup = myReader.nextLine(); 
			myReader.close();
			} 
			catch (FileNotFoundException e) {
				System.out.println("An error occurred.");
				e.printStackTrace();
		}
		
		
		try{
		Course course;
		Group group;
			File myObj = new File("connect/class.txt");
			//File myObj = new File("connect/class-50.txt");
			Scanner myReader = new Scanner(myObj);
			int lec_num=-1;
			ArrayList roomtype = new ArrayList();
			while (myReader.hasNextLine()) {
				String id=myReader.nextLine();
				String subject=myReader.nextLine();
				String section=myReader.nextLine();
				String type= myReader.nextLine();
				if(type.equals("CLC Lecture Theater")){
					roomtype=r;
				}
				else if(type.equals("Laboratory")){
					roomtype=lab;
				}
				else if(type.equals("Lecture Room")){
					roomtype=lec;
				}
				else if(type.equals("Lecture Theater")){
					roomtype=lec_theater;
				}
				else if(type.equals("Tutorial Room")){
					roomtype=tut;
				}
				String lecturerid=myReader.nextLine();
				for(int i=0; i<lecturer.size();i++){
					if (lecturer.get(i).getId().equals(lecturerid)){
						lec_num=i;
					}
				}
				String grouping=myReader.nextLine();
				if(grouping.equals(currentGroup)){
					course= new Course(id,subject,section,roomtype,new ArrayList<Lecturer>(Arrays.asList(lecturer.get(lec_num))));
					courses.add(course);
					tempcourse.add(course);
				}
				else{
					group=new Group(currentGroup,tempcourse);
					groups.add(group);
					currentGroup = grouping;
					tempcourse= new ArrayList();
					course= new Course(id,subject,section,roomtype,new ArrayList<Lecturer>(Arrays.asList(lecturer.get(lec_num))));
					courses.add(course);
					tempcourse.add(course);
				}
			}
			group=new Group(currentGroup,tempcourse);
			groups.add(group);

			
			myReader.close();
			} catch (FileNotFoundException e) {
				System.out.println("An error occurred.");
				e.printStackTrace();
		}
		course = new ArrayList<Course>(courses);
		
		group1 = new ArrayList<Group>(groups);
		group1.forEach(x-> classNum += x.getCourse().size());
		
		
		
		return this;
		
	}
	
	public ArrayList<Room> getRoom(){
		return room;
	}
	
	public ArrayList<Lecturer> getLecturer(){
		return lecturer;
	}
	
	public ArrayList<Course> getCourse(){
		return course;
	}
	
	public ArrayList<Group> getGroup(){
		return group1;
	}
	
	public ArrayList<Time> getTime(){
		return time;
	}
	
	public int getClassNum(){
		return this.classNum;
	}
}
