<?
if ($_SERVER['REQUEST_METHOD'] === "GET") {
    //=========== database connection
    include('config.php');
    $config = mysqli_connect($servernaem,$username,$password,$dbname);
    //========================================================================== Fetch story data based on the category
    if ($_GET['action'] === "storyList") {
        $startFromId = $_GET['startFromId'];
        $category = $_GET['category'];
        $endId = $startFromId + 4;
        // Fetch story data from database
        $selectStoryList = "SELECT (id, title, cover_pic_path ) FROM `story` WHERE category = $category ORDER BY `id` ASC BETWEEN $startFromId AND  $endId";
        $result = $config->query($selectStoryList);
        //Story data to be sent bak to the application
        for ($i = 0; $i < 4; $i++) {
            $storyList = [
                ['title' => $result['title'], 'imgurl' => $result['cover_pic_path']],
            ];
        }
        //setting the response andreturn the values
        header('Content-Type: application/json');
        echo json_encode($storyList);
    }


    //========================================================================== Fetch single story data data based on user request
    if ($_GET['action'] === "storyData") {
        $storyId = $_GET['storyId'];

        // Fetch story data from database
        $selectStoryEpisodes = "SELECT ( episode_title, episode_number ) FROM `episodes` WHERE story_id = $story_id ORDER BY episode_number";
        $result = $config->query($selectStoryEpisodes);

        //Story data to be sent bak to the application
        while ($result['episode_number'] = !NULL) {
            $storydata = [
                ['episode_title' => $result['episode_title'], 'episode_number' => $result['episode_number']],
            ];
        }

        //setting the response andreturn the values
        header('Content-Type: application/json');
        echo json_encode($storydata);
    }


    //========================================================================== Fetch content of the single episode
    if ($_GET['action'] === "episodeContent") {
        $storyId = $_GET['storyId'];
        $episodenumber = $_GET['episode_number'];

        $selectEpisodeContent = "SELECT episode_content FROM `episodes` WHERE story_id = $story_id AND episode_number = $episodenumber";
        $result = $config->query($selectEpisodeContent);

        //setting the response andreturn the values
        header('Content-Type: text/plain');
        echo $result;
    }
}
?>