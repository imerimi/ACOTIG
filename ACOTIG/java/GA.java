import java.util.*;
import java.util.ArrayList;
import java.util.stream.IntStream;

public class GA{
	private Data data;
	
	public GA(Data data){
		this.data=data;
	}
	
	public Population evolve(Population population){
		return mutatePopulation(crossoverPopulation(population));
	}
	
	Population crossoverPopulation (Population population){ //prepare the best 2 scedules for crossover 
		Population crossoverPopulation = new Population(population.getSchedule().size(),data);
		IntStream.range(0,Driver.ELITE_SCHEDULE).forEach(x -> crossoverPopulation.getSchedule().set(x,population.getSchedule().get(x))); //select the best schedule
		IntStream.range(Driver.ELITE_SCHEDULE, population.getSchedule().size()).forEach(x -> { //for other schedule in population, crossover
			if(Driver.CROSSOVER_RATE > Math.random()){  //math.random return random number from 0 to 1
				Schedule schedule1 = selectTournamentPopulation(population).sortByFitness().getSchedule().get(0); //select best schedule
				Schedule schedule2 = selectTournamentPopulation(population).sortByFitness().getSchedule().get(0); //select best schedule
				crossoverPopulation.getSchedule().set(x,crossoverSchedule(schedule1,schedule2)); //crossover both schedule
			}
			else{
				crossoverPopulation.getSchedule().set(x,population.getSchedule().get(x));
			}
		});
		return crossoverPopulation;
	}
	
	Population selectTournamentPopulation (Population population){
		Population tournamentPopulation = new Population(Driver.TOURNAMENT_SELECTION_SIZE,data); 
		IntStream.range(0,Driver.TOURNAMENT_SELECTION_SIZE).forEach(x -> {  
			tournamentPopulation.getSchedule().set(x,population.getSchedule().get((int)(Math.random()*population.getSchedule().size()))); //select best parent
		});
		return tournamentPopulation;
	}
	
	Schedule crossoverSchedule(Schedule schedule1, Schedule schedule2){
		Schedule crossoverSchedule = new Schedule(data).initialize();
		IntStream.range(0,crossoverSchedule.getClasses().size()).forEach(x -> {
			if(Math.random() > 0.5){ //randomly crossover
				crossoverSchedule.getClasses().set(x,schedule1.getClasses().get(x)); //crossover: swap classes between 2 schedule
			}
			else{
				crossoverSchedule.getClasses().set(x,schedule2.getClasses().get(x));
			}
		});
		return crossoverSchedule;
	}
	
	Population mutatePopulation (Population population){
		Population mutatePopulation = new Population(population.getSchedule().size(),data);
		ArrayList<Schedule> schedule = mutatePopulation.getSchedule();
		IntStream.range(0,Driver.ELITE_SCHEDULE).forEach(x -> schedule.set(x,population.getSchedule().get(x))); //select the best schedule
		IntStream.range(Driver.ELITE_SCHEDULE,population.getSchedule().size()).forEach(x ->{ //for other schedule in population, mutate
			schedule.set(x,mutateSchedule(population.getSchedule().get(x))); //mutation: swap classes within schedule
		});
		return mutatePopulation;
	}
	
	
	Schedule mutateSchedule(Schedule mutateSchedule){
		Schedule schedule = new Schedule(data).initialize();
		IntStream.range(0,mutateSchedule.getClasses().size()).forEach(x -> {
			if(Driver.MUTATION_RATE > Math.random()){ //randomly mutate
				mutateSchedule.getClasses().set(x,schedule.getClasses().get(x));
			}
		});
		return mutateSchedule;
	}
}