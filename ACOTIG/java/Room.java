import java.util.*;

public class Room{
	private String code;
	private int capacity;
	private String roomtype;
	
	public Room(String code,String roomtype,int capacity){
		this.code=code;
		this.capacity=capacity;
		this.roomtype=roomtype;
	}
	public String getCode(){
		return code;
	}
	
	public String getRoomType(){
		return roomtype;
	}
	
	public int getCapacity(){
		return capacity;
	}
	
}