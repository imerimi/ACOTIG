import java.util.*;
import java.util.Scanner;
import java.io.FileWriter;
import java.io.PrintWriter;
import java.io.IOException;
import java.lang.*;

public class Driver{
	public static final int POPULATIONSIZE = 10;
	public static final double MUTATION_RATE = 0.1;
	public static final double CROSSOVER_RATE=0.9;
	public static final int TOURNAMENT_SELECTION_SIZE =3;
	public static final int ELITE_SCHEDULE=1;
	public static long startTime;
	public static long endTime;
	public static long totalTime;
	public int scheduleNum =0;
	private Data data;
	private int classNumb=1;
	private static int clash=0;
	private static int tempClash=0;
	private static int counter=0;
	
	public static void main(String[] args){
		startTime = System.nanoTime(); //timer
		try{
			PrintWriter writer = new PrintWriter("C:/xampp/htdocs/fyp/result.txt");
			writer.print("");
			writer.close();
		}
		catch(Exception e){
			System.out.println(e);
		}
		Driver driver= new Driver();
		driver.data = new Data();
		int genNumber= 0;
		GA ga = new GA(driver.data); //pass data to GA
		Population population = new Population(driver.POPULATIONSIZE,driver.data).sortByFitness(); //create population based on population size
		population.getSchedule().forEach(schedule -> System.out.println(schedule.getClashNum())); //print number of clashes
		driver.printSchedule(population.getSchedule().get(0),genNumber); //print schedule
		driver.classNumb=1; //calculate total number of classes
		clash=population.getSchedule().get(0).getClashNum();
		while(counter<5){
		//while(counter<20){  //number greater, less clashes, longer time
			if (population.getSchedule().get(0).getClashNum()==clash){
				counter++;
			}
			else{
				counter=0;
				clash=population.getSchedule().get(0).getClashNum();
			}
			System.out.println("Generation" + ++genNumber);
			System.out.println("Clashes for each population: ");
			population = ga.evolve(population).sortByFitness();
			driver.scheduleNum = 0;
			population.getSchedule().forEach(schedule -> System.out.println(schedule.getClashNum()));
			driver.printSchedule(population.getSchedule().get(0),genNumber);
			driver.classNumb=1;
		
		}
		endTime   = System.nanoTime(); //timer
		totalTime = endTime - startTime; //timer
		System.out.println("Execution time in nanoseconds="+totalTime); //timer
	}
	
	public void printSchedule(Schedule schedule, int gen){
		ArrayList<Class> classes = schedule.getClasses();
		System.out.print("----------------------------------------------------------------------");
		System.out.println("----------------------------------------------------------------------\n\n");
		System.out.println("Class # | Group |       Course(section)         |      Room      |       Lecturer       | Time");
		System.out.print("----------------------------------------------------------------------");
		System.out.println("----------------------------------------------------------------------");
		classes.forEach(x->{
			int majorIndex=data.getGroup().indexOf(x.getGroup());
			int courseIndex = data.getCourse().indexOf(x.getCourse());
			int roomsIndex = data.getRoom().indexOf(x.getRoom());
			int lecturerIndex = data.getLecturer().indexOf(x.getLecturer());
			int timeIndex = data.getTime().indexOf(x.getTime());
			System.out.print("    ");
			System.out.print( String.format(" %1$02d ",classNumb) + "|");
			if (counter==5){
			try{
				FileWriter writer = new FileWriter("C:/xampp/htdocs/fyp/result.txt", true); //overwrite
				writer.write(data.getGroup().get(majorIndex).getName());
				writer.write("\n");
				writer.write(data.getCourse().get(courseIndex).getTitle());
				writer.write("\n");
				writer.write(data.getCourse().get(courseIndex).getSection());
				writer.write("\n");
				writer.write(data.getRoom().get(roomsIndex).getCode());
				writer.write("\n");
				writer.write(data.getTime().get(timeIndex).getTime());
				writer.write("\n");
				writer.close();
			}
			catch(Exception ex){
				System.out.print(ex);
			}
			}
			System.out.print( String.format(" %1$4s ",data.getGroup().get(majorIndex).getName()) + " |");
			System.out.print( String.format(" %1$20s ", data.getCourse().get(courseIndex).getTitle()+ "("+ data.getCourse().get(courseIndex).getSection()) + ")       |");
			System.out.print( String.format(" %1$10s ",data.getRoom().get(roomsIndex).getCode())+"    |");
			System.out.print( String.format(" %1$17s ", data.getLecturer().get(lecturerIndex).getId())+"   |");
			System.out.println( data.getTime().get(timeIndex).getTime());
			classNumb++;
		});
		System.out.print("----------------------------------------------------------------------");
		System.out.println("----------------------------------------------------------------------\n\n");	
		if (schedule.getFitness() == 1){
			System.out.println("Number of records="+(classNumb-1));
		}
	}
}