<?php

class BetTypesSeeder extends Seeder {

	public function run() {

		$betTypes = [
			[
				'name' => 'Near Pin',
				'description' => 'The one who get closest to the pin by one on in short hole get point\'s from the fellow competitor\'s.'
			],
			[
				'name' => 'Second Near Pin',
				'description' => 'The one who get closest to the pin by the second shot in middle hole get point\'s from the follow competitor\'s.'
			],
			[
				'name' => 'Drive Competition',
				'description' => 'The one who made a drive with a longest carry with tee shot get point\'s from the fellow competitor\'s. (usually apply for only ones who could be on fair way)'
			],
			[
				'name' => 'Shortest Drive',
				'description' => 'The one who made a drive with a shortest carry with tee shot gives point\'s to other fellow competitor\'s.'
			],
			[
				'name' => 'Olympic',
				'description' => 'This is a single-put match. Set prize Gold, Silver, Copper and Iron in order to the most far from cup and each player can have 4, 3, 2, 1 point. The tip-in shall be a diamond and can get 5 points form the fellow competitor\'s. If there are a player\'s who could archive all prizes (Gold to Iron) in the round shall be called GRAND SLAM and get 10 points from the fellow competitor\'s.'
			],
			[
				'name' => 'Scrap-Iron',
				'description' => 'This usually play as an option of Olympic. If the player miss a putt of Iron, give a point to the fellow competitor\'s.'
			],
			[
				'name' => 'Under-Ground Olympic',
				'description' => 'If a player made 3 putt in Olympic, the gold player gives 1 point, the silver gives 2 points, copper gives 3 points and iron gives 4 points to the fellow competitor\'s.'
			],
			[
				'name' => 'Skins-Match',
				'description' => 'The top play in each hole can get 1 point from the competitor\'s. If there are 2 top players, the point shall be carried over to next hole.'
			],
			[
				'name' => 'Monte Carlo',
				'description' => 'After the declaration, If the player could make up and down, the player can get 1 point from the fellow competitor\'s. Two putt is 0 but if the player made 3 putt, he\'she gives 1 point to the fellow competitor\'s.'
			],
			[
				'name' => 'Sandwich',
				'description' => 'If the player could make up and down from bunker, the player can get 1 point form the fellow competitor\'s.'
			],
			[
				'name' => 'One Flag',
				'description' => 'Upon the declaration to putt more than 1 putt, if the player could make one putt, the player can get 1 point from the fellow competitor\'s.'
			],
			[
				'name' => 'Horizontal',
				'description' => 'Top player in each hole gets 1 point from the fellow competitor\'s.'
			],
			[
				'name' => 'Vertical',
				'description' => 'Gives points equivalent to the difference in net score to the fellow competitor\'s.'
			],
			[
				'name' => 'Friend',
				'description' => 'Compete with total score of each pair which decided by tee shot in each hole. If 2 players\' tee shots curve right side, these players become a pair. Curving to left side is also the same. So there is possibility to have different pair in each hole.'
			],
			[
				'name' => 'Las Vegas',
				'description' => 'Decide pairs with the same method to Friend. Make two digits number with the score in a pair. Put a lower score into tens place and higher score into ones place within a pair and point\'s is equivalent to the difference between the pairs.'
			],
			[
				'name' => 'Hussein(The Gulf War)',
				'description' => 'The second player in each hole become Hussein and compete with other 3 (Allied). Give point\'s equivalent to the difference; Hussein\'s score X 3 - total score of allied players.'
			],
			[
				'name' => 'In with good fortune! Out with the demons',
				'description' => 'When 3 players\' scores are the same and one player\'s score is worth, give 1 point to each fellow competitor. When 3 players\' scores are the same and one player\'s score is better, get 1 point from each fellow competitor. This rule is applicable on each hole and/or the total.'
			],
			[
				'name' => 'A Cricket',
				'description' => 'Give point\'s to the fellow competitor\'s when shot rough to rough.'
			],
			[
				'name' => 'A Woodcutter, Woodpecker',
				'description' => 'Gives point\'s to the fellow competitor\'s when hit the tree on your escaping shot from woods.'
			],
			[
				'name' => 'A divorced wife',
				'description' => 'Gives point\'s when the ball go into neighboring course.'
			],
			[
				'name' => 'The first bunker',
				'description' => 'Gives point\'s to the fellow competitor\'s when ball go into bunker first time in the play.'
			],
			[
				'name' => 'A Flounder',
				'description' => 'Gives point\'s to the fellow competitor\'s when the player could not escape from bunker at 1 time.'
			],
			[
				'name' => 'Ai○s',
				'description' => 'OB and/or 3 putts are thought as a virus and carry over up to the 9th hole. Gives point\'s to the fellow competitor\'s equivalent to the number of the virus.'
			],
			[
				'name' => 'A Snake',
				'description' => 'Only 3 putts is thought as a virus and carrying over. Other rules are the same to Ai○s.'
			],
			[
				'name' => 'A mole',
				'description' => 'Only sand shot is thought as virus and carrying over. Other rules are the same to Ai○s.'
			],
			[
				'name' => 'Honest John',
				'description' => 'The players declare target score of the day before the starting. If archiving the target exactly, 0 point, if more than the target, the point\'s equivalent to the difference, if less than the target, the point\'s equivalent to 2 times of the difference, and the one who have least point (honest John) gets all the points from the fellow competitors.'
			],
			[
				'name' => 'Red and White War',
				'description' => 'Separate into some teams and compete with average score of the NET.'
			],
			[
				'name' => 'Sink',
				'description' => 'The player\'s gives 5 points to organizer if the player\'s tee shot could not be carried more than smoke ball in ceremonial opening shot.'
			],
			[
				'name' => 'Chicken BBQ',
				'description' => 'The one\'s who could not be an owner through 9 holes give\'s point\'s to the fellow competitor\'s.'
			],
			[
				'name' => 'Imperial Army',
				'description' => 'The one\'s who used English within the game give\'s point\'s to the fellow competitor\'s.'
			],
			[
				'name' => 'Shooting Star',
				'description' => 'In the case, only one player shot into rough with his\'her tee shot (if it is a short hole, could not make the green in one shot), gives 1 point to the fellow competitor\'s.'
			],
			[
				'name' => 'The little princess',
				'description' => 'In the case, only one player could shot onto fairway with his\'her tee shot (if it is a short hole, could make the green in one shot), gets 1 point from the fellow competitor\'s.'
			],
			[
				'name' => 'Speeding',
				'description' => 'Gives point\'s to the fellow competitor\'s when shot onto cart way and the ball jumped.'
			],
			[
				'name' => 'OctopusSquidCentipede',
				'description' => 'Gives point\'s to the fellow competitor\'s when shot the ground hardly.'
			]
		];
		foreach($betTypes as $betType) {
			$bt = new BetType;
			$bt->name = $betType['name'];
			$bt->description = $betType['description'];
			$bt->save();
		}
	}

}
