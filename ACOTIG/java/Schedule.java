import java.util.*;
import java.util.ArrayList;


public class Schedule{
	private final ArrayList<Class> classes; 
	private Data data;
	private int classNumb = 0;
	private int clashNum = 0;
	private boolean isFitnessChanged = true;
	private double fitness = -1;
	
	public Data getData(){
		return data;
	}
	
	public Schedule(Data data){
		this.data=data;
		classes= new ArrayList<Class>(data.getClassNum());
	}
	
	public Schedule initialize(){    // assign data to each class
		new ArrayList<Group>(data.getGroup()).forEach(group ->{
			group.getCourse().forEach(course ->{
				Class newClass = new Class(classNumb++,group,course);
				newClass.setTime(data.getTime().get((int) (data.getTime().size()* Math.random())));
				newClass.setRoom(course.getRoom().get((int) ((course.getRoom().size()-1)*Math.random())));
				newClass.setLecturer(course.getLecturer().get((int) (course.getLecturer().size()*Math.random())));
			 double test= checkClash(newClass);
				while(test !=1){
					newClass.setTime(data.getTime().get((int) (data.getTime().size()* Math.random())));
					newClass.setRoom(course.getRoom().get((int) ((course.getRoom().size()-1)*Math.random())));
					test= checkClash(newClass);
				}
				classes.add(newClass); 
				
			});
		});
		return this;
	}
	
	public int getClashNum(){
		return clashNum;
	}
	
	public ArrayList<Class> getClasses(){
		isFitnessChanged =true;
		return classes;
	}
	
	public double getFitness(){ 
		if(isFitnessChanged==true){
			fitness =calculateFitness();
			isFitnessChanged = false;
		}
		return fitness;
	}
	
	private double checkClash(Class newClass){ 
		clashNum=0;
		ArrayList<Group> group=new ArrayList<Group>(data.getGroup());
		for(int i =0; i<classes.size();i++){
			if(classes.get(i).getTime() == newClass.getTime() && classes.get(i).getId()!=newClass.getId()){
				if(classes.get(i).getRoom()== newClass.getRoom()) clashNum++;  // two class use same room at the same time
				if(classes.get(i).getLecturer() == newClass.getLecturer()) clashNum++;  //lecturer teaches two class at the same time
					for(int j=0; j<group.size();j++){
						if(group.get(j).getCourse().contains(classes.get(i).getCourse()) && group.get(j).getCourse().contains(newClass.getCourse())){
							clashNum++; //two subjects in the same group are conducted at the same time.
						}
					}
				}
			}
		return 1/(double)(clashNum+1);
	}
	

		
	private double calculateFitness(){ //fitness's range[0-1],1->no clashes, 0-> all clashes
		clashNum=0;
		classes.forEach(x ->{  //new type of for loop, similar to (for int i =0; i<classes.size();i++)
			classes.stream().filter(y -> classes.indexOf(y) >= classes.indexOf(x)).forEach(y->{ //avoid mirror classes if AB appears, BA doesn't appear
				if(x.getTime() == y.getTime() && x.getId() != y.getId()){
					if(x.getRoom()== y.getRoom()) clashNum++; //room does not clash
					if(x.getLecturer() == y.getLecturer()) clashNum++;  //lecturer does not clash
						if( x.getGroup().getName().equals("extra") && y.getGroup().getName().equals("Y3SE") || x.getGroup().getName().equals("extra") && y.getGroup().getName().equals("Y3IS") || x.getGroup().getName().equals("extra") && y.getGroup().getName().equals("Y3DS") || x.getGroup().getName().equals("extra") && y.getGroup().getName().equals("Y3GD")){
							clashNum++; //soft constraint: extra subject is famous eletive taken by Y3 student, try to minimize the clashes as many as possible
						}
						new ArrayList<Group>(data.getGroup()).forEach(group ->{
						if(group.getCourse().contains(x.getCourse()) && group.getCourse().contains(y.getCourse())){
							clashNum++; //subject in a group does not clash
						}
					});
				}
			});
				
		});
		return 1/(double)(clashNum+1);
	}
							
	
	
	
	
	public String toString(){
		String returnValue= new String();
		for(int x=0; x<classes.size()-1;x++){
			returnValue += classes.get(x);
		}
		returnValue += classes.get(classes.size()-1);
		return returnValue;
	}
}