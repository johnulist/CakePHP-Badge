Badge Plugin For CakePHP
===========================

This plugin will give you the ability to create and unlock badge for your Users.

Install
----------	
First you have to create the tables
	
	cake schema create --plugin=Badge

And load this plugin

	CakePlugin::load('Badge'); 

That's all

Usage
---------

Badge Table Structure

* **id**
* **name**, Name for the badge
* **description**, Description for the badge
* **metric**, The metric to unlock the badge (for instance "Comment", "Post", "Purchase"...)
* **metric_count**, The limit to unlock the badge (used for unlockMetric() method)
* **unlock_count**, counterCache for unlocks, How many users got this badge
* **created**

##Badge Method

### Badge::unlock($badge_id, $user_id)
unlock a badge for specific User (and check if the user already got this badge)

### Badge::unlockMetric($metric, $count, $user_id)
unlock one (or multiple) badges if the conditions are met. For instance if an User post his fourth comment you should do *$this->Badge->unlockMetric('Comment', 4, $user_id)* and it will unlock badges automatically.

Usage Exemple
--------------

Here is an exemple of an EventListener that would unlock badge when the Event *Model.Comment.add* is fired.

app/Config/bootstrap.php

	CakeEventManager::instance()->attach(new BadgesEventListener());

app/Event/BadgesEventListener.php

	<?php
	App::uses('CakeEventListener','Event');
	class BadgesEventListener implements CakeEventListener{
	
	    public function implementedEvents(){
	        return array(
	            'Model.Comment.add' => 'comments',
	        );
	    }
	
	    public function comments($event){
	        $Comment = $event->subject();
	        $data  = $Comment->data['Comment'];
	        $count = $Comment->find('count', array(
	            'conditions' => array(
	                'user_id' => $data['user_id']
	            ),
	        ));
	        $Badge = ClassRegistry::init('Badge.Badge');
	        $Badge->unlockMetric('Answers', $count, $data['user_id']);
	    }
	
	
	}

	
	

