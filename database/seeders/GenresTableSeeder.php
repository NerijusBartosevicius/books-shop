<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [

            [
                'name' => 'Classic',
                'description' => 'Fiction that has become part of an accepted literary canon, widely taught in schools',
            ],
            [
                'name' => 'Crime/detective',
                'description' => 'Fiction about a crime, how the criminal gets caught and serves time, and the repercussions of the crime',
            ],
            [
                'name' => 'Epic',
                'description' => 'A genre of narrative poetry in a time before history about extraordinary feats that involve religious underpinnings and themes.',
            ],
            [
                'name' => 'Fable',
                'description' => 'Legendary, supernatural tale demonstrating a useful truth',
            ],
            [
                'name' => 'Fairy tale',
                'description' => 'Story about fairies or other magical creatures',
            ],
            [
                'name' => 'Fantasy',
                'description' => 'Fiction in an unreal setting that often includes magic, magical creatures, or the supernatural',
            ],
            [
                'name' => 'Folktale',
                'description' => 'The songs, stories, myths, and proverbs of a people or "folk" as handed down by word of mouth',
            ],
            [
                'name' => 'Gothic fiction',
                'description' => '',
            ],
            [
                'name' => 'Historical fiction',
                'description' => 'Story with fictional characters and events in a historical setting',
            ],
            [
                'name' => 'Horror',
                'description' => 'Fiction in which events evoke a feeling of dread and sometimes fear in both the characters and the reader',
            ],
            [
                'name' => 'Humor',
                'description' => 'Usually a fiction full of fun, fancy, and excitement, meant to entertain and sometimes cause intended laughter; but can be contained in all genres',
            ],
            [
                'name' => 'Legend',
                'description' => 'Story, sometimes of a national or folk hero, that has a basis in fact but also includes imaginative material',
            ],
            [
                'name' => 'Magical realism',
                'description' => 'Story where magical or unreal elements play a natural part in an otherwise realistic environment',
            ],
            [
                'name' => 'Meta fiction',
                'description' => 'Uses self-reference to draw attention to itself as a work of art while exposing the "truth" of a story',
            ],
            [
                'name' => 'Mystery',
                'description' => 'Fiction dealing with the solution of a crime or the revealing of secrets',
            ],
            [
                'name' => 'Mythology',
                'description' => 'Legend or traditional narrative, often based in part on historical events, that reveals human behavior and natural phenomena by its symbolism; often pertaining to the actions of the gods',
            ],
            [
                'name' => 'Mythopoeia',
                'description' => 'Fiction in which characters from religious mythology, traditional myths, folklore and/or history are recast into a re-imagined realm created by the author',
            ],
            [
                'name' => 'Realistic fiction',
                'description' => 'Story that is true to life',
            ],
            [
                'name' => 'Romance',
                'description' => 'Genre which place their primary focus on the relationship and romantic love between two people, which usually has an "emotionally satisfying and optimistic ending".',
            ],
            [
                'name' => 'Satire',
                'description' => 'Usually fiction and less frequently in non-fiction, in which vices, follies, abuses and shortcomings are held up to ridicule, with the intent of shaming individuals, corporations, government, or society itself into improvement.',
            ],
            [
                'name' => 'Science fiction',
                'description' => 'Story based on the impact of actual, imagined, or potential science, often set in the future or on other planets',
            ],
            [
                'name' => 'Short story',
                'description' => 'Fiction of great brevity, usually supports no subplots.',
            ],
            [
                'name' => 'Spy fiction',
                'description' => 'Fiction involving espionage and establishment of modern intelligence agencies.',
            ],
            [
                'name' => 'Superhero fiction',
                'description' => 'Fiction involving costumed crime fighters known as superheroes who often possess superhuman powers and battle with similarly powered criminals known as supervillains.',
            ],
            [
                'name' => 'Swashbuckler',
                'description' => 'Story based on a time of swordsmen, pirates and ships, and other related ideas, usually full of action',
            ],
            [
                'name' => 'Tall tale',
                'description' => 'Humorous story with blatant exaggerations, such as swaggering heroes who do the impossible with nonchalance',
            ],
            [
                'name' => 'Theological fiction',
                'description' => 'Explores the theological ideas which shape attitudes towards religious expression.',
            ],
            [
                'name' => 'Suspense/thriller',
                'description' => 'Fiction about harm about to befall a person or group and the attempts made to evade the harm',
            ],
            [
                'name' => 'Tragicomedy',
                'description' => 'A play or novel containing elements of both comedy and tragedy.',
            ],
            [
                'name' => 'Travel',
                'description' => 'Literature containing elements of the outdoors, nature, adventure, and traveling',
            ],
            [
                'name' => 'Western',
                'description' => 'Fiction set in the American Old West frontier and typically in the late nineteenth to early twentieth century.',
            ],
            [
                'name' => 'Biography',
                'description' => 'A narrative of a person\'s life; when the author is also the main subject, this is an autobiography or memoir',
            ],
            [
                'name' => 'Essay',
                'description' => 'A short literary composition that reflects the author\'s outlook or point',
            ],
            [
                'name' => 'Journalism',
                'description' => 'Reporting on news and current events',
            ],
            [
                'name' => 'Memoir',
                'description' => 'Factual story that focuses on a significant relationship between the writer and a person, place, or object; reads like a short novel',
            ],
            [
                'name' => 'Narrative nonfiction/personal narrative',
                'description' => 'Factual information about a significant event presented in a format that tells a story',
            ],
            [
                'name' => 'Reference',
                'description' => 'Such as a dictionary, thesaurus, encyclopedia, almanac, or atlas',
            ],
            [
                'name' => 'Self improvement',
                'description' => 'Information with the intention of instructing readers on solving personal problems',
            ],
            [
                'name' => 'Speech',
                'description' => 'Public address or discourse',
            ],
            [
                'name' => 'Scientific Article',
                'description' => 'Report on a scientific study, including in the social, natural or other academic disciplines',
            ],
            [
                'name' => 'Textbook',
                'description' => 'Authoritative and detailed factual description of a thing',
            ],
        ];

        Genre::insert($genres);
    }
}
