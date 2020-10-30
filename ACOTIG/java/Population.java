import java.util.*;
import java.util.ArrayList;
import java.util.stream.IntStream;

public class Population{
	private ArrayList<Schedule> schedule;
	
	public Population(int size, Data data){
		schedule = new ArrayList<Schedule>(size);
		IntStream.range(0,size).forEach(x-> schedule.add(new Schedule(data).initialize())); //like python, IntStream.range(0,size) count from 0 until size-1
	}
	
	public ArrayList<Schedule> getSchedule(){
		return this.schedule;
	}
	
	public Population sortByFitness(){  //sort in ascending order
		schedule.sort((schedule1,schedule2)->{
			int returnValue = 0;
			if (schedule1.getFitness()> schedule2.getFitness()){
				returnValue=-1;
			}
			else if (schedule1.getFitness()< schedule2.getFitness()){
				returnValue =1;
			}
			return returnValue;
		});
		return this;
	}
}