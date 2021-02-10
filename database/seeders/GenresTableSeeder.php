<?php

namespace Database\Seeders;

use App\Models\Genre;
use Carbon\Carbon;
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
        $dateNow = Carbon::now();
        $genres = [

            [
                'name' => 'Classic',
                'description' => 'Fiction that has become part of an accepted literary canon, widely taught in schools',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Crime/detective',
                'description' => 'Fiction about a crime, how the criminal gets caught and serves time, and the repercussions of the crime',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Epic',
                'description' => 'A genre of narrative poetry in a time before history about extraordinary feats that involve religious underpinnings and themes.',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Fable',
                'description' => 'Legendary, supernatural tale demonstrating a useful truth',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Fairy tale',
                'description' => 'Story about fairies or other magical creatures',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Fantasy',
                'description' => 'Fiction in an unreal setting that often includes magic, magical creatures, or the supernatural',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Folktale',
                'description' => 'The songs, stories, myths, and proverbs of a people or "folk" as handed down by word of mouth',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Gothic fiction',
                'description' => '',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Historical fiction',
                'description' => 'Story with fictional characters and events in a historical setting',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Horror',
                'description' => 'Fiction in which events evoke a feeling of dread and sometimes fear in both the characters and the reader',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Humor',
                'description' => 'Usually a fiction full of fun, fancy, and excitement, meant to entertain and sometimes cause intended laughter; but can be contained in all genres',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Legend',
                'description' => 'Story, sometimes of a national or folk hero, that has a basis in fact but also includes imaginative material',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Magical realism',
                'description' => 'Story where magical or unreal elements play a natural part in an otherwise realistic environment',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Meta fiction',
                'description' => 'Uses self-reference to draw attention to itself as a work of art while exposing the "truth" of a story',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Mystery',
                'description' => 'Fiction dealing with the solution of a crime or the revealing of secrets',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Mythology',
                'description' => 'Legend or traditional narrative, often based in part on historical events, that reveals human behavior and natural phenomena by its symbolism; often pertaining to the actions of the gods',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Mythopoeia',
                'description' => 'Fiction in which characters from religious mythology, traditional myths, folklore and/or history are recast into a re-imagined realm created by the author',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Realistic fiction',
                'description' => 'Story that is true to life',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Romance',
                'description' => 'Genre which place their primary focus on the relationship and romantic love between two people, which usually has an "emotionally satisfying and optimistic ending".',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Satire',
                'description' => 'Usually fiction and less frequently in non-fiction, in which vices, follies, abuses and shortcomings are held up to ridicule, with the intent of shaming individuals, corporations, government, or society itself into improvement.',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Science fiction',
                'description' => 'Story based on the impact of actual, imagined, or potential science, often set in the future or on other planets',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Short story',
                'description' => 'Fiction of great brevity, usually supports no subplots.',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Spy fiction',
                'description' => 'Fiction involving espionage and establishment of modern intelligence agencies.',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Superhero fiction',
                'description' => 'Fiction involving costumed crime fighters known as superheroes who often possess superhuman powers and battle with similarly powered criminals known as supervillains.',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Swashbuckler',
                'description' => 'Story based on a time of swordsmen, pirates and ships, and other related ideas, usually full of action',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Tall tale',
                'description' => 'Humorous story with blatant exaggerations, such as swaggering heroes who do the impossible with nonchalance',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Theological fiction',
                'description' => 'Explores the theological ideas which shape attitudes towards religious expression.',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Suspense/thriller',
                'description' => 'Fiction about harm about to befall a person or group and the attempts made to evade the harm',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Tragicomedy',
                'description' => 'A play or novel containing elements of both comedy and tragedy.',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Travel',
                'description' => 'Literature containing elements of the outdoors, nature, adventure, and traveling',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Western',
                'description' => 'Fiction set in the American Old West frontier and typically in the late nineteenth to early twentieth century.',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Biography',
                'description' => 'A narrative of a person\'s life; when the author is also the main subject, this is an autobiography or memoir',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Essay',
                'description' => 'A short literary composition that reflects the author\'s outlook or point',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Journalism',
                'description' => 'Reporting on news and current events',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Memoir',
                'description' => 'Factual story that focuses on a significant relationship between the writer and a person, place, or object; reads like a short novel',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Narrative nonfiction/personal narrative',
                'description' => 'Factual information about a significant event presented in a format that tells a story',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Reference',
                'description' => 'Such as a dictionary, thesaurus, encyclopedia, almanac, or atlas',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Self improvement',
                'description' => 'Information with the intention of instructing readers on solving personal problems',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Speech',
                'description' => 'Public address or discourse',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Scientific Article',
                'description' => 'Report on a scientific study, including in the social, natural or other academic disciplines',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Textbook',
                'description' => 'Authoritative and detailed factual description of a thing',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
        ];

        Genre::insert($genres);
    }
}
