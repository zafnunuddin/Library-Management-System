<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Existing Books
        |--------------------------------------------------------------------------
        */

        $existingBooks = [

            [
                'title' => 'Operating System Concepts',
                'author' => 'Abraham Silberschatz',
                'genre' => 'Computer Science',
            ],

            [
                'title' => 'Introduction to Algorithms',
                'author' => 'Thomas H. Cormen',
                'genre' => 'Algorithms & Data Structures',
            ],

            [
                'title' => 'Computer Networking: A Top-Down Approach',
                'author' => 'James F. Kurose',
                'genre' => 'Networking',
            ],

            [
                'title' => 'Database System Concepts',
                'author' => 'Abraham Silberschatz',
                'genre' => 'Database',
            ],

            [
                'title' => 'Artificial Intelligence: A Modern Approach',
                'author' => 'Stuart Russell',
                'genre' => 'Artificial Intelligence',
            ],

            [
                'title' => 'Data Structures in C++',
                'author' => 'Adam Drozdek',
                'genre' => 'Algorithms & Data Structures',
            ],

            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'genre' => 'Software Engineering',
            ],

            [
                'title' => 'Contract Law',
                'author' => 'Ewan McKendrick',
                'genre' => 'Law',
            ],

            [
                'title' => 'Principles of Management',
                'author' => 'David S. Kreitner',
                'genre' => 'Business & Management',
            ],

            [
                'title' => 'Intro to Mathematical Statistics',
                'author' => 'Robert V. Hogg',
                'genre' => 'Statistics',
            ],

        ];


        /*
        |--------------------------------------------------------------------------
        | 3 Books For Every Genre
        |--------------------------------------------------------------------------
        */

        $genres = [

            'Programming',
            'Computer Science',
            'Information Technology',
            'Software Engineering',
            'Database',
            'Networking',
            'Cybersecurity',
            'Artificial Intelligence',
            'Machine Learning',
            'Data Science',
            'Web Development',
            'Mobile App Development',
            'Computer Architecture',
            'Operating Systems',
            'Algorithms & Data Structures',
            'Computer Graphics',
            'Digital Logic Design',
            'Computer Networks',
            'Cloud Computing',
            'Internet of Things (IoT)',
            'Robotics',
            'Mathematics',
            'Statistics',
            'Physics',
            'Electrical & Electronics Engineering',

            'Business & Management',
            'Economics',
            'English & Communication',
            'Research & Thesis',
            'General / Reference',

            'Fiction',
            'Novel',
            'Short Story',
            'Mystery',
            'Thriller',
            'Detective',
            'Adventure',
            'Romance',
            'Historical Fiction',
            'Science Fiction',
            'Fantasy',
            'Horror',
            'Crime',
            'Psychological Fiction',
            'Drama',
            'Comedy',
            'Satire',
            'Dystopian',
            'Biography & Memoir',
            'Young Adult (YA)',

            'Business Administration',
            'BBA',
            'Commerce',
            'Accounting',
            'Finance',
            'Banking',
            'Marketing',
            'Management',
            'Human Resource Management',
            'Entrepreneurship',
            'International Business',

            'Law',
            'Sociology',
            'Psychology',
            'Political Science',
            'English Literature',
            'Communication',
            'Education',
            'History',
            'Geography',
        ];


        /*
        |--------------------------------------------------------------------------
        | Book Title Templates
        |--------------------------------------------------------------------------
        */

        $titleTemplates = [

            'Programming' => [
                'Modern Programming Fundamentals',
                'Programming Principles and Practice',
                'Advanced Programming Techniques',
            ],

            'Computer Science' => [
                'Foundations of Computer Science',
                'Essential Computer Science',
                'Advanced Computer Science',
            ],

            'Information Technology' => [
                'Information Technology Fundamentals',
                'Modern Information Technology',
                'Advanced IT Systems',
            ],

            'Software Engineering' => [
                'Software Engineering Principles',
                'Modern Software Development',
                'Software Engineering Practices',
            ],

            'Database' => [
                'Database Management Systems',
                'Modern Database Design',
                'Advanced Database Systems',
            ],

            'Networking' => [
                'Computer Networking Fundamentals',
                'Modern Network Architecture',
                'Advanced Networking Concepts',
            ],

            'Cybersecurity' => [
                'Cybersecurity Fundamentals',
                'Network Security and Protection',
                'Advanced Cybersecurity',
            ],

            'Artificial Intelligence' => [
                'Introduction to Artificial Intelligence',
                'Artificial Intelligence Systems',
                'Advanced AI Applications',
            ],

            'Machine Learning' => [
                'Machine Learning Fundamentals',
                'Practical Machine Learning',
                'Advanced Machine Learning',
            ],

            'Data Science' => [
                'Introduction to Data Science',
                'Practical Data Science',
                'Advanced Data Science',
            ],

            'Web Development' => [
                'Modern Web Development',
                'Web Design and Development',
                'Advanced Web Programming',
            ],

            'Mobile App Development' => [
                'Mobile Application Development',
                'Android and Mobile Development',
                'Advanced Mobile App Design',
            ],

            'Computer Architecture' => [
                'Computer Organization and Architecture',
                'Modern Computer Architecture',
                'Advanced Computer Systems',
            ],

            'Operating Systems' => [
                'Operating Systems Fundamentals',
                'Modern Operating Systems',
                'Advanced Operating Systems',
            ],

            'Algorithms & Data Structures' => [
                'Algorithms and Data Structures',
                'Advanced Algorithms',
                'Data Structures and Problem Solving',
            ],

            'Computer Graphics' => [
                'Computer Graphics Fundamentals',
                'Principles of Computer Graphics',
                'Advanced Computer Graphics',
            ],

            'Digital Logic Design' => [
                'Digital Logic Design',
                'Digital Electronics and Logic',
                'Advanced Digital Logic',
            ],

            'Computer Networks' => [
                'Computer Networks Fundamentals',
                'Network Design and Management',
                'Advanced Computer Networks',
            ],

            'Cloud Computing' => [
                'Cloud Computing Fundamentals',
                'Cloud Infrastructure and Services',
                'Advanced Cloud Computing',
            ],

            'Internet of Things (IoT)' => [
                'Introduction to Internet of Things',
                'IoT Systems and Applications',
                'Advanced Internet of Things',
            ],

            'Robotics' => [
                'Introduction to Robotics',
                'Robotics Engineering',
                'Advanced Robotics Systems',
            ],

            'Mathematics' => [
                'College Mathematics',
                'Advanced Engineering Mathematics',
                'Mathematical Methods',
            ],

            'Statistics' => [
                'Introduction to Statistics',
                'Statistical Methods',
                'Applied Statistics',
            ],

            'Physics' => [
                'Fundamentals of Physics',
                'University Physics',
                'Applied Physics',
            ],

            'Electrical & Electronics Engineering' => [
                'Electrical Engineering Fundamentals',
                'Electronic Devices and Circuits',
                'Advanced Electrical Engineering',
            ],

            'Business & Management' => [
                'Principles of Business Management',
                'Modern Business Management',
                'Strategic Management',
            ],

            'Economics' => [
                'Principles of Economics',
                'Microeconomics and Macroeconomics',
                'Applied Economics',
            ],

            'English & Communication' => [
                'English Communication Skills',
                'Professional English Communication',
                'Academic Communication',
            ],

            'Research & Thesis' => [
                'Research Methodology',
                'Thesis Writing Guide',
                'Academic Research Methods',
            ],

            'General / Reference' => [
                'General Knowledge Reference',
                'Academic Reference Guide',
                'Complete Reference Handbook',
            ],

            'Fiction' => [
                'The Silent Garden',
                'The Last Journey',
                'A Story Beyond Time',
            ],

            'Novel' => [
                'The Lost Horizon',
                'The Hidden Path',
                'A Journey of Dreams',
            ],

            'Short Story' => [
                'Collected Short Stories',
                'Stories of Life',
                'Tales of the Unexpected',
            ],

            'Mystery' => [
                'The Missing Manuscript',
                'Mystery at Midnight',
                'The Secret Room',
            ],

            'Thriller' => [
                'The Final Chase',
                'Danger in the Shadows',
                'The Last Warning',
            ],

            'Detective' => [
                'The Detective Files',
                'Case of the Missing Diamond',
                'The Silent Witness',
            ],

            'Adventure' => [
                'Journey to the Unknown',
                'The Hidden Island',
                'Adventure Beyond the Mountains',
            ],

            'Romance' => [
                'A Promise of Love',
                'Letters from the Heart',
                'Love Beyond Distance',
            ],

            'Historical Fiction' => [
                'Echoes of the Past',
                'The Forgotten Kingdom',
                'A Chronicle of Time',
            ],

            'Science Fiction' => [
                'Beyond the Stars',
                'The Future World',
                'Journey Through Space',
            ],

            'Fantasy' => [
                'The Kingdom of Magic',
                'The Last Dragon',
                'Legends of the Enchanted World',
            ],

            'Horror' => [
                'The House in the Dark',
                'Whispers at Midnight',
                'The Haunted Room',
            ],

            'Crime' => [
                'The Perfect Crime',
                'Crime Scene Investigation',
                'The Last Suspect',
            ],

            'Psychological Fiction' => [
                'Inside the Mind',
                'The Silent Thought',
                'Fragments of Memory',
            ],

            'Drama' => [
                'The Final Act',
                'A Life on Stage',
                'The Broken Promise',
            ],

            'Comedy' => [
                'Laughing Through Life',
                'The Funny Side of Life',
                'Adventures of an Ordinary Man',
            ],

            'Satire' => [
                'The Modern World',
                'A Funny Look at Society',
                'The Society We Live In',
            ],

            'Dystopian' => [
                'The Last City',
                'A World Without Freedom',
                'The New Order',
            ],

            'Biography & Memoir' => [
                'Lives That Changed the World',
                'Memoirs of a Lifetime',
                'Stories of Great Lives',
            ],

            'Young Adult (YA)' => [
                'The Summer We Remember',
                'Young Dreams',
                'The Road Ahead',
            ],

            'Business Administration' => [
                'Fundamentals of Business Administration',
                'Business Administration Today',
                'Advanced Business Administration',
            ],

            'BBA' => [
                'BBA Fundamentals',
                'Business Studies for BBA',
                'BBA Management Concepts',
            ],

            'Commerce' => [
                'Principles of Commerce',
                'Modern Commerce',
                'Advanced Commerce Studies',
            ],

            'Accounting' => [
                'Financial Accounting',
                'Principles of Accounting',
                'Advanced Accounting',
            ],

            'Finance' => [
                'Principles of Finance',
                'Corporate Finance',
                'Financial Management',
            ],

            'Banking' => [
                'Introduction to Banking',
                'Modern Banking Systems',
                'Banking and Financial Services',
            ],

            'Marketing' => [
                'Principles of Marketing',
                'Modern Marketing Management',
                'Digital Marketing Strategies',
            ],

            'Management' => [
                'Principles of Management',
                'Modern Management',
                'Strategic Management Concepts',
            ],

            'Human Resource Management' => [
                'Human Resource Management',
                'Strategic Human Resource Management',
                'Human Resources and Organizations',
            ],

            'Entrepreneurship' => [
                'Introduction to Entrepreneurship',
                'Entrepreneurship and Innovation',
                'Starting a New Business',
            ],

            'International Business' => [
                'International Business Fundamentals',
                'Global Business Management',
                'International Trade and Business',
            ],

            'Law' => [
                'Introduction to Law',
                'Principles of Law',
                'Modern Legal Studies',
            ],

            'Sociology' => [
                'Introduction to Sociology',
                'Modern Sociological Theory',
                'Society and Social Change',
            ],

            'Psychology' => [
                'Introduction to Psychology',
                'Modern Psychology',
                'Principles of Human Behavior',
            ],

            'Political Science' => [
                'Introduction to Political Science',
                'Political Theory and Practice',
                'Modern Political Science',
            ],

            'English Literature' => [
                'Introduction to English Literature',
                'History of English Literature',
                'Modern Literary Studies',
            ],

            'Communication' => [
                'Principles of Communication',
                'Effective Communication Skills',
                'Professional Communication',
            ],

            'Education' => [
                'Introduction to Education',
                'Educational Psychology',
                'Modern Teaching Methods',
            ],

            'History' => [
                'World History',
                'History of Civilization',
                'Modern History',
            ],

            'Geography' => [
                'Introduction to Geography',
                'World Geography',
                'Physical and Human Geography',
            ],
        ];


        /*
        |--------------------------------------------------------------------------
        | Create Existing Books
        |--------------------------------------------------------------------------
        */

        foreach ($existingBooks as $index => $book) {

            Book::updateOrCreate(
                [
                    'title' => $book['title'],
                    'author' => $book['author'],
                ],
                [
                    'edition' => '1st Edition',
                    'genre' => $book['genre'],
                    'serial_no' => 'EX-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                    'isbn' => '978000000' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                    'language' => 'English',
                    'publisher' => 'Academic Press',
                    'publication_year' => 2022,
                    'printing_no' => '1st',
                    'publication_place' => 'Dhaka, Bangladesh',
                    'shelf_location' => 'Shelf A-' . ($index + 1),

                    // EVERY BOOK = 10
                    'quantity' => 10,
                    'available_quantity' => 10,

                    'book_abstract' =>
                        'A useful academic book covering important concepts, theories and practical applications related to ' .
                        $book['genre'] . '.',

                    'table_of_contents' =>
                        "Chapter 1 - Introduction\n" .
                        "Chapter 2 - Basic Concepts\n" .
                        "Chapter 3 - Core Principles\n" .
                        "Chapter 4 - Practical Applications\n" .
                        "Chapter 5 - Advanced Topics",

                    'status' => 'Available',
                    'uploaded_at' => now(),
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Create 3 Books Per Genre
        |--------------------------------------------------------------------------
        */

        $counter = 1;

        foreach ($genres as $genre) {

            $titles = $titleTemplates[$genre] ?? [
                "Introduction to {$genre}",
                "Modern {$genre}",
                "Advanced {$genre}",
            ];

            for ($i = 0; $i < 3; $i++) {

                $title = $titles[$i];

                $book = [

                    'title' => $title,

                    'author' => 'Academic Author ' . $counter,

                    'edition' => ($i + 1) . 'st Edition',

                    'genre' => $genre,

                    'serial_no' =>
                        'BK-' .
                        strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $genre), 0, 3)) .
                        '-' .
                        str_pad($counter, 4, '0', STR_PAD_LEFT),

                    'isbn' =>
                        '978' .
                        str_pad($counter, 10, '0', STR_PAD_LEFT),

                    'language' => 'English',

                    'publisher' => 'Academic Press',

                    'publication_year' => 2020 + ($i % 5),

                    'printing_no' => ($i + 1) . 'st',

                    'publication_place' => 'Dhaka, Bangladesh',

                    'shelf_location' =>
                        'Shelf ' .
                        chr(65 + (($counter - 1) % 10)) .
                        ', Row ' .
                        (($counter - 1) % 5 + 1),

                    // EVERY BOOK = 10
                    'quantity' => 10,

                    'available_quantity' => 10,

                    'book_abstract' =>
                        'This book provides an academic introduction to ' .
                        $genre .
                        ', including fundamental concepts, important theories, practical applications and advanced topics.',

                    'table_of_contents' =>
                        "Chapter 1 - Introduction\n" .
                        "Chapter 2 - Basic Concepts\n" .
                        "Chapter 3 - Important Principles\n" .
                        "Chapter 4 - Applications\n" .
                        "Chapter 5 - Advanced Topics",

                    'status' => 'Available',

                    'uploaded_at' => now(),
                ];


                Book::updateOrCreate(
                    [
                        'title' => $book['title'],
                        'author' => $book['author'],
                    ],
                    $book
                );

                $counter++;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Finished
        |--------------------------------------------------------------------------
        */

        $this->command?->info(
            'Book seeding completed successfully. 3 books were added for every genre, with quantity 10 per book.'
        );
    }
}