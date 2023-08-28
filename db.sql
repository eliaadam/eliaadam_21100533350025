CREATE TABLE `stories` (
  `story_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100),
  `category` VARCHAR(100),
  `cover_pic_path` VARCHAR(255),
  PRIMARY KEY (`story_id`)
);

CREATE TABLE `episodes` (
  `episode_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `story_id` INT UNSIGNED NOT NULL,
  `episode_number` SMALLINT UNSIGNED NOT NULL,
  `episode_title` VARCHAR(50),
  `content` TEXT,
  FOREIGN KEY (`story_id`) REFERENCES `stories`(`story_id`),
  INDEX (`story_id`),
  PRIMARY KEY (`episode_id`)
);


