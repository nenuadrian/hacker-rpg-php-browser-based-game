


CREATE TABLE `analytics` (
  `analytic_id` bigint(20) NOT NULL,
  `event` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `server_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

CREATE TABLE `conversation` (
  `conversation_id` int(11) NOT NULL,
  `user_1_id` int(11) NOT NULL,
  `user_2_id` int(11) DEFAULT NULL,
  `last_replier_id` int(11) NOT NULL,
  `unseen` tinyint(4) DEFAULT NULL,
  `last_reply_timestamp` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) NOT NULL,
  `parent_conversation_id` int(11) DEFAULT NULL,
  `message` longtext,
  `replies` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


CREATE TABLE `email_queue` (
  `queue_id` bigint(20) NOT NULL,
  `target` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `template_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `processed_at` timestamp NULL DEFAULT NULL,
  `language` varchar(3) NOT NULL DEFAULT 'en',
  `target_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `data` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


CREATE TABLE `group_application` (
  `application_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `personal_statement` text NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


CREATE TABLE `hacker_group` (
  `hacker_group_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ranking` int(11) NOT NULL DEFAULT '0',
  `ranking_points` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

INSERT INTO `hacker_group` (`hacker_group_id`, `name`, `created_at`, `ranking`, `ranking_points`) VALUES
(1, 'asdf', '2016-09-06 07:12:19', 0, 0),
(2, 'test2', '2016-09-06 07:13:08', 1, 1);

-- --------------------------------------------------------


CREATE TABLE `hacker_group_application` (
  `hacker_group_application_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hacker_group_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


CREATE TABLE `hacker_quote` (
  `quote_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


INSERT INTO `hacker_quote` (`quote_id`, `content`, `author`) VALUES
(1, 'I Hate Programming.\nI Hate Programming.\nI Hate Programming.\nIt works!\nI Love Programming.\n', NULL),
(2, 'Perl - The only language that looks the same before and after RSA encryption.', 'Keith Bostic'),
(3, 'I invented the term Object-Oriented, and I can tell you I did not have C++ in mind.', 'Alan Kay'),
(4, 'Debugging is anticipated with distaste, performed with reluctance, and bragged about forever.', 'Dan Kaminsky'),
(5, 'Memory is like an orgasm. It\'s a lot better if you don\'t have to fake it.', 'Seymour Cray on virtual memory'),
(6, 'The most exciting phrase to hear in science, the one that heralds new discoveries, is not \'Eureka!\' but \'That\'s funny...\'', 'Isaac Asimov'),
(7, 'A computer lets you make more mistakes faster than any other invention in human history, with the possible exceptions of handguns and tequila.', 'Mitch Ratcliffe'),
(8, 'Engineers are all basically high-functioning autistics who have no idea how normal people do stuff.', 'Cory Doctorow'),
(9, 'Any sufficiently advanced magic is indistinguishable from a rigged demonstration.', NULL),
(10, 'Vi is a subset of evil.', NULL),
(11, 'The difference between theory and practice is smaller in theory than in practice.', NULL),
(12, 'There are only 3 numbers of interest to a computer scientist: 1, 0 and infinity.', NULL),
(13, 'Debuggers don\'t remove bugs. They only show them in slow motion.', NULL),
(14, 'Never trust a programmer in a suit.', NULL),
(15, 'In theory, theory and practice are the same. In practice, they\'re not.', NULL),
(16, 'Most software today is very much like an Egyptian pyramid with millions of bricks piled on top of each other, with no structural integrity, but just done by brute force and thousands of slaves.', 'Alan Kay'),
(17, 'The trouble with programmers is that you can never tell what a programmer is doing until it\'s too late.\"', 'Seymour Cray'),
(18, 'Measuring programming progress by lines of code is like measuring aircraft building progress by weight.', 'Bill Gates'),
(19, 'It is practically impossible to teach good programming style to students that have had prior exposure to BASIC. As potential programmers, they are mentally mutilated beyond hope of regeneration.', 'E. W. Dijkstra'),
(20, 'With regard to adding more programmers to get a project done faster - Nine people can\'t make a baby in a month.', 'Fred Brooks'),
(21, 'There are two ways of constructing a software design: One way is to make it so simple that there are obviously no deficiencies, and the other way is to make it so complicated that there are no obvious deficiencies. The first method is far more difficult.', 'C.A.R. Hoare.'),
(22, 'Weeks of coding can save you hours of planning.', NULL),
(23, 'A programmer started to cuss\nBecause getting to sleep was a fuss\nAs he lay there in bed\nLooping \'round in his head\nwas: while(!asleep()) sheep++;\n', NULL),
(24, 'Beware of bugs in the above code; I have only proved it correct, not tried it.', 'Donald Knuth'),
(25, 'C++: an octopus made by nailing extra legs onto a dog.', 'Steve Taylor'),
(26, 'If Java had true garbage collection, most programs would delete themselves upon execution.', 'Robert Sewell'),
(27, 'My definition of an expert in any field is a person who knows enough about what\'s really going on to be scared.', 'P. J. Plauger'),
(28, 'An expert is a man who has made all the mistakes that can be made in a very narrow field.', 'Niels Bohr'),
(29, 'Theory is when you know something, but it doesn\'t work. Practice is when something works, but you don\'t know why. Programmers combine theory and practice: Nothing works and they don\'t know why.', NULL),
(30, 'You can stand on the shoulders of giants OR a big enough pile of dwarfs, works either way.', NULL),
(31, 'XML is like violence - if it\'s not working for you, you\'re not using enough of it.', NULL),
(32, 'Whereas Europeans generally pronounce my name the right way (\'Nick-louse Veert\'), Americans invariably mangle it into \'Nickel\'s Worth.\' This is to say that Europeans call me by name, but Americans call me by value.', 'Niklaus Wirth'),
(33, 'Any fool can write code that a computer can understand. Good programmers write code that humans can understand.', 'Martin Fowler'),
(34, 'There are 10 types of people in the world, those who can read binary, and those who can\'t.', NULL),
(35, 'Programs must be written for people to read, and only incidentally for machines to execute.', 'From SICP'),
(36, 'Every language has an optimization operator. In C++ that operator is ‘//’', NULL),
(37, 'Programming today is a race between software engineers striving to build bigger and better idiot-proof programs, and the Universe trying to produce bigger and better idiots. So far, the Universe is winning.', 'Rich Cook'),
(38, 'An idiot with a computer is a faster, better idiot.', 'Rich Julius'),
(39, 'Brevity is the soul of wit.', 'Shakespeare'),
(40, 'The question of whether computers can think is just like the question of whether submarines can swim.', 'Edsger W. Dijkstra'),
(41, 'There\'s no test like production.', NULL),
(42, 'We better hurry up and start coding, there are going to be a lot of bugs to fix.', NULL),
(43, 'Mostly, when you see programmers, they aren\'t doing anything. One of the attractive things about programmers is that you cannot tell whether or not they are working simply by looking at them. Very often they\'re sitting there seemingly drinking coffee and gossiping, or just staring into space. What the programmer is trying to do is get a handle on all the individual and unrelated ideas that are scampering around in his head.', 'Charles M Strauss'),
(44, 'The greatest performance improvement of all is when a system goes from not-working to working.', 'John Ousterhout'),
(45, 'Computer science education cannot make anybody an expert programmer any more than studying brushes and pigment can make somebody an expert painter.', 'Eric Raymond'),
(46, 'To iterate is human, to recurse divine.', 'L. Peter Deutsch'),
(47, 'C++ : Where friends have access to your private members.', 'Gavin Russell Baker'),
(48, 'A computer is a stupid machine with the ability to do incredibly smart things, while computer programmers are smart people with the ability to do incredibly stupid things. They are, in short, a perfect match.', 'Bill Bryson'),
(49, 'UNIX is basically a simple operating system, but you have to be a genius to understand the simplicity.', 'Dennis Ritchie'),
(50, 'Walking on water and developing software from a specification are easy if both are frozen.', 'Edward V Berard'),
(51, 'It always takes longer than you expect, even when you take into account Hofstadter\'s Law.', 'Hofstadter\'s Law'),
(52, 'Always code as if the guy who ends up maintaining your code will be a violent psychopath who knows where you live.', 'Rick Osborne'),
(53, 'Debugging is twice as hard as writing the code in the first place. Therefore, if you write the code as cleverly as possible, you are, by definition, not smart enough to debug it.', 'Brian Kernighan'),
(54, 'The first 90% of the code accounts for the first 90% of the development time. The remaining 10% of the code accounts for the other 90% of the development time.', 'Tom Cargill'),
(55, 'Java is to JavaScript what Car is to Carpet.', 'Chris Heilmann'),
(56, 'If you want to set off and go develop some grand new thing, you don\'t need millions of dollars of capitalization. You need enough pizza and Diet Coke to stick in your refrigerator, a cheap PC to work on and the dedication to go through with it.', 'John Carmack'),
(57, 'The idea that I can be presented with a problem, set out to logically solve it with the tools at hand, and wind up with a program that could not be legally used because someone else followed the same logical steps some years ago and filed for a patent on it is horrifying.', 'John Carmack on software patents'),
(58, 'Some people, when confronted with a problem, think \"I know, I\'ll use regular expressions.\" Now they have two problems.', 'Jamie Zawinski'),
(59, 'There are only two kinds of languages: the ones people complain about and the ones nobody uses.', 'Bjarne Stroustrup'),
(60, 'I have always wished for my computer to be as easy to use as my telephone; my wish has come true because I can no longer figure out how to use my telephone.', 'Bjarne Stroustrup'),
(61, 'Linux is only free if your time has no value.', 'Jamie Zawinski'),
(62, 'It works on my machine.', NULL),
(63, 'It should be noted that no ethically-trained software engineer would ever consent to write a DestroyBaghdad procedure. Basic professional ethics would instead require him to write a DestroyCity procedure, to which Baghdad could be given as a parameter.', 'Nathaniel S Borenstein'),
(64, 'In order to understand recursion, one must first understand recursion.', NULL),
(65, 'On two occasions I have been asked [by members of Parliament], \'Pray, Mr. Babbage, if you put into the machine wrong figures, will the right answers come out?\' I am not able rightly to apprehend the kind of confusion of ideas that could provoke such a question.', 'Charles Babbage'),
(66, 'If debugging is the process of removing software bugs, then programming must be the process of putting them in.', 'Edsger Dijkstra'),
(67, 'PHP is a minor evil perpetrated and created by incompetent amateurs, whereas Perl is a great and insidious evil perpetrated by skilled but perverted professionals.', 'Jon Ribbens'),
(68, 'Perfection is achieved, not when there is nothing more to add, but when there is nothing left to take away.', 'Antoine de Saint Exupéry'),
(69, 'Computer Science is no more about computers than astronomy is about telescopes.', 'E. W. Dijkstra'),
(70, 'Better train people and risk they leave – than do nothing and risk they stay.', NULL),
(71, 'Before software should be reusable, it should be usable.', 'Ralph Johnson'),
(72, 'The generation of random numbers is too important to be left to chance.', 'Robert R. Coveyou, Oak Ridge National Laboratory'),
(73, 'Anyone who considers arithmetic methods of producing random digits is, of course, in a state of sin.', 'John von Neumann'),
(74, 'APL, I believe, can only be learned by writing one-liners–only by seeing in a sense, what you can compress into a line.', 'Alan J Perlis'),
(75, 'I love deadlines. I like the whooshing sound they make as they fly by.', 'Douglas Adams'),
(76, 'A good programmer looks both ways before crossing a one-way street.', NULL),
(77, 'Owning a computer without programming is like having a kitchen and using only the microwave oven.', 'Charles Petzold'),
(78, 'The only \"intuitive\" interface is the nipple. After that it\'s all learned.', 'Bruce Ediger'),
(79, 'God could create the world in six days because he didn\'t have to make it compatible with the previous version.', NULL),
(80, 'We should forget about small efficiencies, say about 97% of the time: premature optimization is the root of all evil.', 'Donald Knuth'),
(81, 'When art critics get together they talk about Form and Structure and Meaning. When artists get together they talk about where you can buy cheap turpentine.', 'Pablo Picasso'),
(82, 'I would love to change the world, but they won\'t give me the source code.', NULL),
(83, 'If we\'re supposed to work in Hex, why have we only got A fingers?', NULL),
(84, 'Programming is like sex: one mistake and you have to support it for the rest of your life.', 'Michael Sinz'),
(85, 'Think twice before you start programming or you will program twice before you start thinking.', NULL),
(86, 'If I had more time, I would have written a shorter letter.', 'Cicero'),
(87, 'Software is like sex: It\'s better when it\'s free.', 'Linus Torvalds'),
(88, 'Profanity is the one language all programmers know best.', NULL),
(89, 'Any sufficiently advanced technology is indistinguishable from magic.', 'Sir Arthur C Clarke'),
(90, 'You start writing code, I\'ll go see what the customer wants', NULL),
(91, 'Good programmers never write what they can steal or borrow.', 'Jeff Atwood'),
(92, 'Debugging is like farting - it\'s not so bad when it\'s your own code.', NULL),
(93, 'When I am working on a problem I never think about beauty. I think only how to solve the problem. But when I have finished, if the solution is not beautiful, I know it is wrong.', 'R. Buckminster Fuller'),
(94, 'If you don\'t have time to do it right, when will you have time to do it over?', 'John Wooden, basketball coach'),
(95, 'Sufficiently advanced incompetence is indistinguishable from malice.', 'Clark\'s law'),
(96, 'Don\'t worry about people stealing your ideas. If it\'s original, you\'ll have to ram it down their throats.', 'Howard Aiken'),
(97, 'Saying that Java is good because it works on all platforms is like saying anal sex is good because it works on all genders.', NULL),
(98, '... one of the main causes of the fall of the Roman Empire was that, lacking zero, they had no way to indicate successful termination of their C programs.', 'Robert Firth'),
(99, 'Never memorize what you can look up in books.', 'Albert Einstein'),
(100, 'There are only two hard problems in Computer Science: cache invalidation and naming things.', 'Phil Karlton'),
(101, 'It is easier to optimize correct code than to correct optimized code.', NULL),
(102, 'Software and cathedrals are much the same - first we build them, then we pray.', NULL),
(103, 'Rules for optimization:\n1. Don\'t do it.\n2. (for experts only) Don\'t do it yet.\n', 'Michael A Jackson'),
(104, 'Confidence, n.: The feeling you have before you understand the situation.', NULL),
(105, 'There are two major products that come out of Berkeley: LSD and UNIX. We don\'t believe this to be a coincidence.', 'Jeremy S. Anderson'),
(106, 'Good judgement is the result of experience ... Experience is the result of bad judgement.', 'Fred Brooks'),
(107, 'If architects built houses the way programmers built programs, the first woodpecker to come along would destroy civilization.', 'Gerald Weinberg'),
(108, 'All problems in computer science can be solved with another level of indirection.', 'David Wheeler'),
(109, 'Java is a DSL to transform big Xml documents into long exception stack traces.', 'Scott Bellware'),
(110, 'There are only two industries that refer to their customers as users: the computer industry and the drug trade.', 'Edward Tufte'),
(111, 'If the code and the comments disagree, then both are probably wrong.', NULL),
(112, 'Man is the best computer we can put aboard a spacecraft...and the only one that can be mass produced with unskilled labor.', 'Wernher von Braun'),
(113, 'I have not failed. I\'ve just found 10,000 ways that won\'t work.', 'Thomas A. Edison'),
(114, 'When debugging, novices insert corrective code; experts remove defective code.', 'Richard Pattis'),
(115, 'Simplicity is prerequisite for reliability.', 'Edsger Dijkstra'),
(116, 'You can\'t solve social problems through technical means.', NULL),
(117, 'Question: How does a large software project get to be one year late? Answer: One day at a time!', 'Fred Brooks'),
(118, 'Pasting code from the Internet into production code is like chewing gum found in the street.', NULL),
(119, 'One programmer can do in one day what two programmers can do in two.', NULL),
(120, 'Java. The elegant simplicity of C++. The blazing speed of Smalltalk.', NULL),
(121, 'Giving pointers and threads to programmers is like giving whisky and car keys to teenagers.', 'P. J. O\'Rourke'),
(122, 'There is not now, nor has there ever been, nor will there ever be, any programming language in which it is the least bit difficult to write bad code.', NULL),
(123, 'Human beings are not accustomed to being perfect, and few areas of human activity demand it. Adjusting to the requirement for perfection is, I think, the most difficult part of learning to program.', NULL),
(124, 'Think of compilation as cooking. Dynamic typing means the steak is juicy and still a little red, like red meat is supposed to be. Static typing means you burnt it to a crisp.', 'Erik Naggum'),
(125, 'It seems to me you can program with discipline or you can program with bondage and discipline. You can\'t avoid the discipline either way, but bondage appeals to some people.', 'Patrick Logan'),
(126, 'One who works with their hands is a laborer.\nOne who works with their hands and their mind is a craftsman.\nOne who works with their hands, mind and heart is an artist.\n', NULL),
(127, 'Nothing is more permanent than a temporary solution.', 'Thomas\' First Law'),
(128, 'Fast, Cheap, Reliable: Pick any two.', NULL),
(129, 'Make it correct,\nmake it clear,\nmake it concise,\nmake it fast.\n\nIn that order.\n', 'Wes Dyer'),
(130, 'Must be zero, or equal to MAPI_UNICODE. In either case, however, this parameter is ignored.', 'MSDN'),
(131, 'The best code is no code at all.', NULL),
(132, 'Easy things should be easy and hard things should be possible.', 'Larry Wall'),
(133, 'How do we convince people that in programming simplicity and clarity —in short: what mathematicians call \"elegance\"— are not a dispensable luxury, but a crucial matter that decides between success and failure?\n', 'Edsger W. Dijkstra'),
(134, 'It takes an intelligent person to build something complex; it takes a genius to build something simple.', NULL),
(135, 'Programmers usually have good reasons for making bad decisions.', NULL),
(136, 'Let the code run free, if it needs to be debugged, it will come back.', NULL),
(137, 'If you can\'t explain something to a six-year-old, you really don\'t understand it yourself.', 'Albert Einstein'),
(138, 'My programs don\'t have bugs, they just develop random features.', NULL),
(139, 'In C, its easy to shoot yourself in the foot. C++ makes it more difficult, but when you do, you\'ll blow your whole leg off.', 'Stroustrup'),
(140, 'Multi-threading is the art of screwing things up before, during or after something else.', NULL),
(141, 'Programming languages are like girlfriends: The new one is better because you are better.', NULL),
(142, 'When all you have is a hammer, everything starts to look like a nail.', NULL),
(143, 'Engineering is the art of doing with one dollar what any damn fool can do with two.', 'From Space Systems Failures by David M. Harland and Ralph D. Lorenz'),
(144, 'I don\'t care if it works on your machine! We are not shipping your machine!', 'Ovidiu Platon'),
(145, 'I know it doesn\'t sound like a big effort, but programmers are really, really lazy, and they like to minimize motion. They\'d use feeder tubes if the Health Department would let them.', 'Steve Yegge'),
(146, 'UNIX is user friendly. It just picks whom it wants to be friends with.', NULL),
(147, '\"It depends\" is the answer to all good software engineering questions, but to be a good software engineer, you should know on what it depends, and why.\n', NULL),
(148, 'You\'re never done, you just run out of time.', NULL),
(149, 'Program testing can be a very effective way to show the presence of bugs, but is hopelessly inadequate for showing their absence.', 'Edsger Dijkstra'),
(150, 'The competent programmer is fully aware of the limited size of his own skull. He therefore approaches his task with full humility, and avoids clever tricks like the plague.', 'Edsger Dijkstra'),
(151, 'Good design adds value faster than it adds cost.', 'Thomas C. Gale'),
(152, 'With all due respect John, I am the head of IT and I have it on good authority. If you type \"Google\" into Google, you can break the Internet.\n', 'Jen, \"The IT Crowd\"\n'),
(153, 'The two most common elements in the universe are hydrogen and stupidity.', 'Harlan Ellison'),
(154, 'There is no IRL, only AFK', NULL),
(155, 'A common mistake that people make when trying to design something completely foolproof is to underestimate the ingenuity of complete fools.', 'Douglas Adams'),
(156, 'A C program is like a fast dance on a newly waxed dance floor by people carrying razors.', 'Waldi Ravens'),
(157, 'God did not create the world in seven days; for six days he screwed around and then pulled an all-nighter.', NULL),
(158, 'if you are a programmer working in 2003 and you don\'t know the basics of characters, character sets, encodings, and Unicode, and I catch you, I\'m going to punish you by making you peel onions for 6 months in a submarine.', 'Joel Spolsky'),
(159, 'If we\'d asked the customers what they wanted, they would have said \"faster horses\".\n', 'Henry Ford'),
(160, 'The word “experienced” often refers to someone who’s gotten away with doing the wrong thing more frequently than you have.\n', 'Laurence Gonzales'),
(161, 'Real Programmers don\'t comment their code. If it was hard to write, it should be hard to understand.', NULL),
(162, '\'Goto\' is always evil, like in \'goto school\' or \'goto work\'.\n', NULL),
(163, 'Your code is both good and original. Unfortunately the parts that are good are not original, and the parts that are original are not good.', NULL),
(164, 'They did not know it was impossible, so they did it!', 'Mark Twain'),
(165, 'I (...) am rarely happier than when spending an entire day programming my computer to perform automatically a task that would otherwise take me a good ten seconds to do by hand.', 'Douglas Adams'),
(166, 'People who are really serious about software should make their own hardware.', 'Alan Kay'),
(167, 'Consider the postage stamp: its usefulness consists in the ability to stick to one thing until it gets there.', 'Josh Billings'),
(168, 'Don\'t tell people how to do things, tell them what to do and let them surprise you with their results.', 'George S. Patton'),
(169, 'Multitasking is the art of distracting yourself from two things you’d rather not be doing by doing them simultaneously.', NULL),
(170, 'Code never lies, comments sometimes do.', 'Ron Jeffries'),
(171, 'A computer programmer is a device for turning coffee into bugs.', 'Bram Moolenaar'),
(172, 'Any sufficiently advanced bug is indistinguishable from a feature.', 'Rich Kulawiec'),
(173, 'From a programmer\'s point of view, the user is a peripheral that types when you issue a read request.', 'Peter Williams'),
(174, 'Should array indices start at 0 or 1? My compromise of 0.5 was rejected without, I thought, proper consideration.', 'Stan Kelly-Bootle'),
(175, 'God is Real, unless declared Integer.', NULL),
(176, 'We all agree on the necessity of compromise. We just can\'t agree on when it\'s necessary to compromise.', 'Larry Wall'),
(177, 'And don\'t tell me there isn\'t one bit of difference between null and space, because that\'s exactly how much difference there is.', 'Larry Wall'),
(178, 'It won\'t be covered in the book. The source code has to be useful for something, after all...', 'Larry Wall'),
(179, 'Just don\'t create a file called -rf.', 'Larry Wall'),
(180, 'Sex is fun, but it probably doesn\'t solve all your problems.', 'Larry Wall'),
(181, 'My assertion that we can do better with computer languages is a persistent belief and fond hope, but you\'ll note I don\'t actually claim to be either rational or right. Except when it\'s convenient.', 'Larry Wall'),
(182, 'People who deal with bits should expect to get bitten.', 'Jon Bentley'),
(183, 'All parts should go together without forcing. You must remember that the parts you are reassembling were disassembled by you. Therefore, if you can\'t get them together again, there must be a reason. By all means, do not use a hammer.', 'IBM Manual, 1925'),
(184, 'There is nothing quite so permanent as a quick fix.', NULL),
(185, 'Shipping is a feature.', 'Richard Campbell'),
(186, 'If C didn\'t exist, we would be programming in OBOL, PASAL or BASI', NULL),
(187, 'The Internet? Is that thing still around?', 'Homer Simpson'),
(188, 'They have computers, and they may have other weapons of mass destruction.', 'Janet Reno'),
(189, 'Only Half of programming is coding. The other 90% is debugging.', NULL),
(190, 'Now I\'m a pretty lazy person and am prepared to work quite hard in order to avoid work.', 'Martin Fowler'),
(191, 'What I cannot build, I do not understand.', 'Richard Feynman'),
(192, 'First, solve the problem. Then, write the code.', 'John Johnson'),
(193, 'Artificial Intelligence is no match for natural stupidity.', NULL),
(194, 'The more bizarre the behavior, the more stupid the mistake.', 'Ed\'s Law of Debugging'),
(195, 'There are no significant bugs in our released software that any significant number of users want fixed.', 'Bill Gates'),
(196, 'Yes, sometimes Perl looks like line noise to the uninitiated, but to the seasoned Perl programmer, it looks like checksummed line noise with a mission in life.', 'Randal Schwartz'),
(197, 'Any problem in computer science can be solved with another layer of indirection. But that usually will create another problem.', 'David Wheeler'),
(198, 'In my experience, one of the most significant problems in software development is assuming. If you assume a method will passed the right parameter value, the method will fail.', 'Paul M. Duvall'),
(199, 'The sooner we start coding fewer frameworks and more programs the sooner we’ll become better programmers.', 'Warped Java Guy Elementary Java Solutions'),
(200, 'Starting a startup is hard, but having a 9 to 5 job is hard too, and in some ways a worse kind of hard.', 'Paul Graham'),
(201, 'In essence, let the market design the product.', 'Paul Graham'),
(202, 'A startup now can be just a pair of 22 year old guys. A company like that can move much more easily than one with 10 people, half of whom have kids.', 'Paul Graham'),
(203, 'Startups almost never get it right the first time. Much more commonly you launch something, and no one cares. Don’t assume when this happens that you’ve failed. That’s normal for startups. But don’t sit around doing nothing. Iterate.', 'Paul Graham'),
(204, 'The key to performance is elegance, not battalions of special cases.', 'Jon Bentley and Doug McIlroy'),
(205, 'You’ll spend far more time babysitting old technologies than implementing new ones.', 'Jason Hiner IT Dirty Secrets'),
(206, 'No one hates software more than software developers.', 'Jeff Atwood'),
(207, 'I was a C++ programmer before I started designing Ruby. I programmed in C++ exclusively for two or three years. And after two years of C++ programming, it still surprised me.', 'Matz'),
(208, 'Good architecture is necessary to give programs enough structure to be able to grow large without collapsing into a puddle of confusion.', 'Douglas Crockford'),
(209, 'Programming is difficult. At its core, it is about managing complexity. Computer programs are the most complex things that humans make. Quality is illusive and elusive.', 'Douglas Crockford'),
(210, 'Code reuse is the Holy Grail of Software Engineering.', 'Douglas Crockford'),
(211, 'The structure of software systems tend to reflect the structure of the organization that produce them.', 'Douglas Crocford'),
(212, 'I went to school to learn how to program software applications, which inevitably have bug defects. There was no course at my university on testing, debugging, profiling, or optimization. These things you have to learn on your own, usually in a tight deadline.', 'Juixe TechKnow'),
(213, 'To most Java developers, Ruby/Rails is like a mistress. Ruby/Rails is young, new, and exciting; but eventually we go back to old faithful, dependable, and employable Java with some new tricks and idioms and we are the better programmer for it.', 'Juixe TechKnow'),
(214, 'You might as well pay your customers 50K because they are just your QA.', 'Juixe TechKnow'),
(215, 'You can\'t eliminate problems, but you can make trades to get problems that you prefer over the ones you have now.', 'Eric Sink’s Axiom of Software Development'),
(216, 'Manually managing blocks of memory in C is like juggling bars of soap in a prison shower: It\'s all fun and games until you forget about one of them.', NULL),
(217, 'If it doesn\'t work, it doesn\'t matter how fast it doesn\'t work.', 'Ravera\'s observation on premature optimization'),
(218, 'Any set of procedures, no matter how well intentioned or useful, that are too difficult to follow, will be circumvented.', 'Ravera\'s First Law of System Administration'),
(219, 'Deleted code is debugged code.', 'Jeff Sickel'),
(220, 'All programs have at least one bug remaining and can be optimized by one byte. Thus, by mathematical induction, all programs can be reduced to one byte. And it won\'t work.', NULL),
(221, 'The sooner you get behind in your work, the more time you have to catch up.', NULL),
(222, 'It’s hard to read through a book on the principles of magic without glancing at the cover periodically to make sure it isn’t a book on software design.', 'Bruce Tognazzini'),
(223, 'Java is like a variant of the game of Tetris in which none of the pieces can fill gaps created by the other pieces, so all you can do is pile them up endlessly.', 'Steve Yegge'),
(224, 'Software is hard.', 'Donald Knuth'),
(225, 'Designing software in a team is like writing poetry in a committee meeting.', 'Joel Spolsky'),
(226, 'Education is the process of learning more and more about less and less until one knows everything about nothing and is entitled to call oneself \'Doctor\'.', NULL),
(227, 'You have to \"solve\" the problem once in order to clearly define it and then solve it again to create a solution that works.\n', NULL),
(228, 'A logician trying to explain logic to a programmer is like a cat trying to explain to a fish what it\'s like to get wet.', NULL),
(229, 'Documentation is like sex. When it\'s good, it\'s fantastic. When it\'s bad, it\'s still better than nothing.', NULL),
(230, 'Three things should never be seen in the process of being created: laws, sausage, and software.', NULL),
(231, 'I have found that the reason a lot of people are interested in artificial intelligence is the same reason a lot of people are interested in artificial limbs: they are missing one.', 'David Parnas'),
(232, 'On the 7th day ... God began debugging.', NULL),
(233, 'If we can\'t fix it, then it ain\'t broke.', 'Jon Bentley'),
(234, 'Every truth passes through three stages before it is recognized. In the first, it is ridiculed, in the second it is opposed, in the third it is regarded as self-evident.', 'Arthur Schopenhauer'),
(235, 'Fight code entropy.', 'John Carmack'),
(236, 'The cheapest, fastest, and most reliable components are those that aren\'t there.', 'Gordon Bell'),
(237, 'Good programmers learn more from \"That\'s not what I expected!\" than from getting it right the first time.\n', NULL),
(238, 'Computers are useless. They can only give you answers.', 'Pablo Picasso'),
(239, 'For every complex problem there is an answer that is clear, simple, and wrong.', 'H L Mencken'),
(240, 'When you want to do something differently from the rest of the world, it\'s a good idea to look into whether the rest of the world knows something you don\'t.', NULL),
(241, 'If you require information, do not free memory containing the information.', 'MSDN'),
(242, 'Part of the inhumanity of the computer is that, once it is competently programmed and working smoothly, it is completely honest.', 'Isaac Asimov'),
(243, 'Simplicity is the ultimate sophistication.', 'Leonardo da Vinci'),
(244, 'Anything that can go wrong will go wrong, anything that can\'t go wrong will go wrong anyway.', NULL),
(245, 'Code is never finished, only abandoned.', NULL),
(246, 'Don\'t code today what you can\'t debug tomorrow', NULL),
(247, 'Software is like entropy. It is difficult to grasp, weighs nothing, and obeys the second law of thermodynamics; i.e. it always increases.', NULL),
(248, 'Don\'t fix it if it ain\'t broke presupposes that you can\'t improve something that works reasonably well already. If the world\'s inventors had believed this, we\'d still be driving Model A Fords and using outhouses.', 'H. W. Kenton'),
(249, 'Inside every complex program is a simple program trying to get out.', NULL),
(250, 'Users are a terrible thing. Systems would be infinitely more stable without them.', 'Michael T. Nygard.'),
(251, 'If it doesn\'t work, change the documentation.', NULL),
(252, 'If you can build it, your users can break it.', NULL),
(253, 'C is quirky, flawed and an enormous success.', 'Dennis Ritchie'),
(254, 'Hardware is the part of a system you can kick. Software is the one you can only curse at.', NULL),
(255, 'Good software, like wine, takes time.', 'Joel Spolsky'),
(256, 'The use of COBOL cripples the mind; its teaching should, therefore, be regarded as a criminal offence.', 'Edsger Dijkstra'),
(257, 'If you give someone a program, you will frustrate them for a day; if you teach them how to program, you will frustrate them for a lifetime.', NULL),
(258, 'The best things are simple, but finding these simple things is not simple.', NULL),
(259, 'Software is either testable or detestable.', NULL),
(260, 'The definition of insanity is doing the same thing over and over and expecting a different result.', NULL),
(261, 'Are you quite sure that all those bells and whistles, all those wonderful facilities of your so called powerful programming languages, belong to the solution set rather than the problem set?', 'Edsger W. Dijkstra'),
(262, 'I have always found that plans are useless, but planning is indispensable.', 'Dwight D. Eisenhower'),
(263, 'If the automobile had followed the same development cycle as the computer, a Rolls-Royce would today cost $100, get a million miles per gallon, and explode once a year, killing everyone inside.', 'Robert X. Cringely'),
(264, 'You want a dot operator in PHP?\neval(str_replace(\'.\', \'->\', $code_with_dot_operator))\n', 'Matthew Leffler'),
(265, 'In a world without walls and fences, who needs Windows and Gates?', NULL),
(266, 'It\'s interface, not in your face.', 'Kai Krause'),
(267, 'No code is faster than no code.', NULL),
(268, 'I finally found a definition for \"middleware\". \"Middleware\" is the software nobody wants to pay for.\n', 'Chris Stone'),
(269, 'If you lie to the compiler, it will get its revenge.', 'Henry Spencere'),
(270, 'The primary duty of an exception handler is to get the error out of the lap of the programmer and into the surprised face of the user. Provided you keep this cardinal rule in mind, you can\'t go far wrong.', 'Verity Stob'),
(271, 'A fool with a tool is still a fool.', NULL),
(272, 'Never attribute to malice that which can be adequately explained by stupidity.', 'Hanlon\'s Razor'),
(273, 'Once you\'ve dressed and before you leave the house, look in the mirror and take at least one thing off.', 'Coco Chanel'),
(274, 'The function name should define everything the function does.', NULL),
(275, 'Every revolutionary idea seems to evoke three stages of reaction: One, it\'s completely impossible. Two, it\'s possible, but it\'s not worth doing. Three, I said it was a good idea all along.', 'Arthur C. Clarke'),
(276, 'Make something fool-proof and someone will make a better fool.', NULL),
(277, 'The real money isn\'t in the software. It\'s in the service you build with that software.', 'Jeff Atwood'),
(278, 'The limits of my language mean the limits of my world.', 'Ludwig Wittgenstein'),
(279, 'Compatibility means deliberately repeating other people\'s mistakes.', NULL),
(280, '[The common definition of estimate is] \"An estimate is the most optimistic prediction that has a non-zero probability of coming true\" . . .\nAccepting this definition leads irrevocably toward a method called what\'s-the-earliest- date-by-which-you-can\'t-prove-you-won\'t-be- finished estimating.\n', 'Tom DeMarco'),
(281, 'All programmers are optimists.', 'Frederick Brooks'),
(282, 'C++ is more of a rube-goldberg type thing full of high-voltages, large chain-driven gears, sharp edges, exploding widgets, and spots to get your fingers crushed. And because of it\'s complexity many (if not most) of it\'s users don\'t know how it works, and can\'t tell ahead of time what\'s going to cause them to loose an arm.', 'Grant Edwards'),
(283, 'C: a language that combines all the elegance and power of assembly language with all the readability and maintainability of assembly language.', NULL),
(284, 'Selecting a project due date before the requirements are properly gathered is like selecting which corner you want to paint yourself into, while simultaneously negating the doorway as a viable option.', 'Chris Ames'),
(285, 'Like a gas, software expands to fill its containing memory completely.', NULL),
(286, 'If you get it free, it is worthless. If you pay for it, it has value. If you build it yourself, it is priceless.', 'Raj More'),
(287, 'When a professional race car driver races, his pulse gets lower and he relaxes. \nWhen I code it is the same thing.\n', 'Jun-ichiro Hagino'),
(288, 'C++ is to C as Lung Cancer is to Lung.', NULL),
(289, 'People who think, \"Oh this is a one-off,\" need to be offed, or perhaps politely removed from the project.\n', 'George Neville-Neil'),
(290, 'Organizations which design systems are constrained to produce designs which are copies of the communication structures of these organizations.', 'Conway\'s Law'),
(291, 'An ideal world is left as an exercise to the reader.', 'From Paul Graham\'s \"On Lisp\"'),
(292, 'What you’ve described, “The bottleneck in writing code isn’t in the writing of the code, it’s in understanding and conceptualising what needs to be done,” is common to all highly abstract programming languages. Writing Haskell, for example, involves an hour of meditation followed by the emission of a fold expression.\n', 'Jonathan Feinberg'),
(293, 'Complexity has nothing to do with intelligence, simplicity does.', 'Larry Bossidy'),
(294, 'C is to programming as Latin is to literature.', NULL),
(295, 'Think of it this way: threads are like salt, not like pasta. You like salt, I like salt, we all like salt. But we eat more pasta.', 'Larry McVoy'),
(296, 'A programmer never dies he just degrades gracefully.', NULL),
(297, 'All real programmers know C of course.', 'Jeff Atwood'),
(298, 'Good enough is neither.', 'Jim Spivey'),
(299, 'Use four digits. A new millenium is coming.', 'Jon Bentley (1976)'),
(300, 'KISS - Keep It Simple Stupid', NULL),
(301, 'If you want to confuse your enemies, give them the source code. If you want to really confuse them, give them the documentation.', NULL),
(302, 'Good programmers invest the effort to learn how to use current practices. Not-so-good programmers just learn the buzzwords, and that’s been a software industry constant for a half century.', 'Boris Beizer'),
(303, 'Processes and methodologies can make good servants but are poor masters.', 'Mark Dowd, John McDonald & Justin Schuh'),
(304, 'Simplicity is hard to build, easy to use, and hard to charge for. Complexity is easy to build, hard to use, and easy to charge for.', 'Chris Sacca'),
(305, 'If you\'ve seen one picture of the Mandelbrot Set, you\'ve seen them all.', 'Bill Karwin'),
(306, 'The third version is the first version that doesn\'t suck.', 'Mike Simpson'),
(307, 'Computers make it easier to do a lot of things, but most of the things they make it easier to do don\'t need to be done.', 'Andy Rooney'),
(308, 'Like wine, the mastery of programming matures with time. But, unlike wine, it gets sweeter in the process.', 'Lawrence Mucheka'),
(309, 'Amateur programmers think there are 1000 bytes in a kilobyte; Real Programmers know there are 1024 meters in a kilometer.', NULL),
(310, 'A documented bug is not a bug; it is a feature.', 'James P. MacLennan'),
(311, 'I\'m not a great programmer; I\'m just a good programmer with great habits.', 'Kent Beck'),
(312, 'If you use copy and paste while you\'re coding, you\'re probably committing a design error.', 'David Parnas'),
(313, 'Programming is not like being in the CIA; you don\'t get credit for being sneaky. It\'s more like advertising; you get lots of credit for making your connections as blatant as possible.', 'Steve McConnell on coupling from, \"Code Complete.\"'),
(314, 'It\'s not what the software does. It\'s what the user does.', 'Hugh Macleod'),
(315, 'Good programmers know what to write. Great ones know what to rewrite (and reuse).', 'Eric Raymond'),
(316, 'Testing like the TSA.', 'David Heinemeier Hansson on testing too much'),
(317, 'When in doubt, leave it out.', 'Joshua Bloch'),
(318, 'A computer scientist counts to ten: 0, 1, 2, 3, 4 ...\nEveryone else counts to ten: 1, 2, 3, 4, 5\n', NULL),
(319, 'A complex system that works is invariably found to have evolved from a simple system that worked.', 'John Gall'),
(320, 'Enlightened trial and error outperforms the planning of flawless intellects.', 'David Kelly'),
(321, 'It\'s OK to figure out murder mysteries, but you shouldn\'t need to figure out code. You should be able to read it.', 'Steve McConnell'),
(322, 'Working software is the primary measure of progress.', 'Agile Manifesto'),
(323, 'Simplicity - the art of maximizing the amount of work not done - is essential.', 'Agile Manifesto'),
(324, 'C trades a slap on the wrist at compile time for a knife in the back at run time.', NULL),
(325, 'Elegance is not optional.', 'Richard A. O\'Keefe (from The Craft of Prolog)'),
(326, 'It makes no sense to try to do what we can. We must do what is necessary.', 'Winston Churchill'),
(327, '80 percent of my problems are simple logic errors. 80 percent of the remaining problems are pointer errors. The remaining problems are hard.', 'Mark Donner, IBM Watson Research Center'),
(328, 'Software isn\'t about methodologies, languages, or even operating systems. It is about working applications.', 'Christopher Baus'),
(329, '... what society overwhelmingly asks for is snake oil. Of course, the snake oil has the most impressive names — otherwise you would be selling nothing — like \"Structured Analysis and Design\", \"Software Engineering\", \"Maturity Models\", \"Management Information Systems\", \"Integrated Project Support Environments\" \"Object Orientation\" and \"Business Process Re-engineering\" (the latter three being known as IPSE, OO and BPR, respectively).\n', 'Edsger W. Dijkstra'),
(330, 'Python\'s syntax succeeds in combining the mistakes of Lisp and Fortran. I do not construe that as progress.', 'Larry Wall'),
(331, 'He who hasn\'t hacked assembly language as a youth has no heart. He who does as an adult has no brain.', 'John Moore'),
(332, 'Any intelligent fool can make things bigger and more complex. It takes a touch of genius - and a lot of courage - to move in the opposite direction.', 'E.F. Schumacher'),
(333, 'If it doesn\'t have to work, we can do it real quick.', 'Watts Humphrey'),
(334, 'If at first you don\'t succeed, try/catch, try/catch again.', NULL),
(335, 'Software Engineering isn\'t rocket science ... it\'s harder.', NULL),
(336, 'I do not fear computers. I fear the lack of them.', 'Isaac Asimov'),
(337, 'Never underestimate the disparity between developer excitement and user apathy.', NULL),
(338, 'Lines of code are only worth counting, when time has come to delete them.', NULL),
(339, 'Sure, it\'s overkill. But you can never have too much overkill...', NULL),
(340, 'The reason we plan ahead is so that we don\'t have to do anything right now.', NULL),
(341, 'Don\'t worry if it doesn\'t work right. If everything did, you\'d be out of a job.', 'Mosher\'s Law of Software Engineering'),
(342, 'Code is everything I thought poetry was, back when we were in school. Clean, expressive, urgent, all-encompassing. Fourteen lines can open up to fill the available universe.', 'Richard Powers'),
(343, 'I\'ve never written the best code I\'ve ever written.', NULL),
(344, 'The most likely way for the world to be destroyed, most experts agree, is by accident. That\'s where we come in; we\'re computer professionals. We cause accidents.', 'Nathaniel Borenstein'),
(345, 'If your bug has a one in a million chance of happening, it\'ll happen next tuesday.', NULL),
(346, 'The programmer, like the poet, works only slightly removed from pure thought-stuff. He builds his castles in the air, from air, creating by exertion of the imagination. Few media of creation are so flexible, so easy to polish and rework, so readily capable of realizing grand conceptual structures.', 'Frederick P. Brooks Jr.'),
(347, 'When I have a specific goal in mind and a complicated piece of code to write, I spend my time making it happen rather than telling myself stories about it.', 'Steve Yegge'),
(348, 'Only in wealth, there is room for a bad idea.', 'Jasper van der Meer'),
(349, 'Team debugging: the act of intimidating a PC into doing for two people what it refuses to do for one.', NULL),
(350, 'I get as much enjoyment from trashing code as I do from scratching it out in the first place!', NULL),
(351, 'It can scarcely be denied that the supreme goal of all theory is to make the irreducible basic elements as simple and as few as possible without having to surrender the adequate representation of a single datum of experience.', 'Albert Einstein'),
(352, 'God is a hacker, not an engineer. You can do reverse engineering, but you can’t do reverse hacking.', 'Francis Crick'),
(353, 'All programming is an exercise in caching.', 'Terje Mathisen'),
(354, 'Talk is cheap, show me the code!', 'Linus Torvalds'),
(355, '* No technique works if it isn\'t used.\n* Ethics change with technology.\n* \"F × S = k\" the product of freedom and security is a constant.\n', 'Niven\'s laws'),
(356, 'In effect, we conjure the spirits of the computer with our spells.', 'From SICP'),
(357, 'This is important, and a little hard to understand. English is useful because it\'s a mess. Since English is a mess, it maps well onto the problem space, which is also a mess, which we call reality. Similarly, Perl was designed to be a mess (though in the nicest of possible ways).', 'Larry Wall'),
(358, 'You can have a negative percent chance of succeeding in a task. For example, if you have a -5% chance of succeeding, not only will you fail every time you make an attempt, you will also fail 1 in 20 times that you don\'t even try.', NULL),
(359, 'Rules are for the obedience of the inexperienced and the guidance of the wise.', NULL),
(360, 'There is a great satisfaction in building good tools for other people to use.', 'Freeman Dyson'),
(361, 'Process is no substitute for synaptic activity.', 'Jeff DeLuca'),
(362, 'If I have not seen as far as others, it is because giants were standing on my shoulders.', 'Hal Abelson'),
(363, 'Every dark corner you haven\'t explored with your flashlight is full of bugs.', 'Kent Beck and Martin Fowler'),
(364, 'Singleton is a misconcept in OOP unless it\'s used as a misconcepted paradigm for application development.', NULL),
(365, 'Anyone who has a wife and small kids knows that programming belongs to the easy things in life.', NULL),
(366, 'The goal of Computer Science is to build something that will last at least until we\'ve finished building it.', NULL),
(367, 'Good web applications should look like trifle.', 'Cal Henderson'),
(368, 'The time machine\'s software will have a recursive main method.', NULL),
(369, 'Behind Every Successful Coder, there\'an even more successful De-Coder to understand that Code.', NULL),
(370, 'In the good old days physicists repeated each other\'s experiments, just to be sure. Today they stick to FORTRAN, so that they can share each other\'s programs, bugs included.', 'Edsger W. Dijkstra'),
(371, 'Some programmers try to reach higher by standing on other programmers\' shoulders. Other programmers try to reach higher by standing on other programmers\' toes.', NULL),
(372, 'If our customers wanted a product that worked that way, tell them to purchase a product that works that way.', NULL),
(373, 'It’s hardware that makes a machine fast. It’s software that makes a fast machine slow.', 'Craig Bruce'),
(374, 'If you\'re going to break it, then break it good. Break everything. Get to the very front of the line. Don\'t like move up a couple of slots. That\'s pointless.', 'Anders Hejlsberg'),
(375, 'There are 10 types of people. Those who can read ternary, those who can\'t and those who mistake it for binary.', NULL),
(376, 'The whole HTML validation exercise is questionable, but validating as XHTML is flat-out masochism. Only recommended for those that enjoy pain. Or programmers. I can\'t always tell the difference.', 'Jeff Atwood'),
(377, 'You can write software expecting the hardware to be perfect, unfortunately hardware is not perfect and you have to fix it in code.', 'W. Giraud'),
(378, 'A well-written program is its own heaven; a poorly-written program is its own hell.', 'Tao of Programming'),
(379, 'It\'s hard enough to find an error in your code when you\'re looking for it; it\'s even harder when you\'ve assumed your code is error-free.', 'Steve McConnell'),
(380, 'Perspective is worth 80 I.Q. points', 'Alan Kay'),
(381, 'Arrogance in computer science is measured in nano-Dijkstras.', 'Alan Kay'),
(382, 'Design bugs are often subtle and occur by evolution with early assumptions being forgotten as new features or uses are added to a system.', 'Fernando J. Corbató'),
(383, 'Any sufficiently well-documented lisp program contains an ML program in its comments.', NULL),
(384, 'It compiles. Ship it!', NULL),
(385, 'People who find Wiki-markup too difficult to use and need a WYSIWYG-editor shouldn\'t be using a Wiki in the first place.', NULL),
(386, 'j++; // increment j', NULL),
(387, 'One Page Principle: A specification that will not fit on one page of 8.5x11 inch paper cannot be understood.', 'Mark Ardis'),
(388, 'Jesus saves but only Buddha makes incremental backups.', NULL),
(389, 'They won\'t tell you that they don\'t understand it; they will happily invent their way through the gaps and obscurities.', 'V.A. Vyssotsky on software programmers and their views on specifications'),
(390, 'Software with no bugs is obsolete.', NULL),
(391, 'Computer programmers don\'t byte, they nibble a bit.', NULL),
(392, 'In software, the most beautiful code, the most beautiful functions, and the most beautiful programs are sometimes not there at all.', 'Jon Bentley'),
(393, 'If it is worth doing once, it is worth automating...', NULL),
(394, 'Anything that can go wrong, will go wrong.', 'Murphy\'s Law'),
(395, 'Tell me what you need and I\'ll tell you how to get along without it.', NULL),
(396, 'The 50-50-90 rule: Anytime you have a 50-50 chance of getting something right, there\'s a 90% probability you\'ll get it wrong.', NULL),
(397, 'The whole point of getting things done is knowing what to leave undone.', 'Oswald Chambers'),
(398, 'I\'ll try to be nicer if you try to be smarter.', 'Assaf Nitzan');
INSERT INTO `hacker_quote` (`quote_id`, `content`, `author`) VALUES
(399, 'When a programming language is created that allows programmers to program in simple English, it will be discovered that programmers cannot speak English.', NULL),
(400, 'One man\'s constant is another man\'s variable.', 'Alan J. Perlis'),
(401, 'Ready, fire, aim: the fast approach to software development.\nReady, aim, aim, aim, aim: the slow approach to software development. \n', NULL),
(402, 'Programmer - an organism that turns coffee into software.', NULL),
(403, 'Though a program be but three lines long, someday it will have to be maintained.', 'Tao Of Programming'),
(404, 'Great things are not done by impulse, but by a series of small things brought together.', 'Vincent van Gogh'),
(405, 'When it comes to code it never pays to rush.', 'Marick\'s Law'),
(406, 'True glory consists in doing what deserves to be written; in writing what deserves to be read.', 'Pliny the Elder'),
(407, 'Don’t fix bugs later; fix them now.', 'Steve Maguire'),
(408, 'Blame doesn\'t fix bugs.', NULL),
(409, 'I will not be a lemming and follow the crowd over the cliff and into the C.', 'John Beidler'),
(410, 'The C Programming Language — A language which combines the flexibility of assembly language with the power of assembly language.', NULL),
(411, 'C(++) is a write-only, high-level assembler language.', 'Stefan Van Baelen'),
(412, 'As soon as we started programming, we found to our surprise that it wasn\'t as easy to get programs right as we had thought.', 'Maurice Wilkes'),
(413, 'Any technology that surpasses 50% penetration will never double again (in any number of months).', 'Peter Norvig\'s law'),
(414, 'I’ve finally learned what ‘upward compatible’ means. It means we get to keep all our old mistakes.', 'Dennie van Tassel'),
(415, 'What happens in the mind of a fine artist is nothing different from that going on in the mind of an expert coder. Both see and thrive in the quintessential nature of patterns.', 'Lawrence Mucheka'),
(416, 'If you don\'t think you\'re doing great things, you\'re probably right.', NULL),
(417, 'Development has two outputs... Code & Bugs', NULL),
(418, 'Errors, like straws, upon the surface flow; He who would search for pearls must dive down below.', 'John Dryden'),
(419, 'I think there\'s a world market for about five computers.', 'Thomas J Watson Senior, 1945'),
(420, 'There\'s more than one way to do it.', 'Larry Wall about Perl'),
(421, 'It is often easier to not do something dumb than it is to do something smart.', NULL),
(422, 'Every program attempts to expand until it can read mail. Those programs which cannot so expand are replaced by ones which can.', 'Jamie Zawinski'),
(423, 'As a rule, software systems do not work well until they have been used, and have failed repeatedly, in real applications.', 'Dave Parnas'),
(424, 'The goal is to deliver clean code that works - now.', 'Kent Beck'),
(425, '...basically, avoid comments. If your code needs a comment to be understood, it would be better to rewrite it so it\'s easier to understand.', 'Rob Pike'),
(426, 'The function of good software is to make the complex appear to be simple.', 'Grady Booch'),
(427, 'Intellectuals solve problems; geniuses prevent them.', 'Albert Einstein'),
(428, 'If you don\'t fail at least 90 percent of the time, you\'re not aiming high enough.', 'Alan Kay'),
(429, 'Web Development is a lot like kickboxing: You have to watch your cookies.', NULL),
(430, 'A programmer that is 10 times better than another will probably be happy making only 3 times as much.', 'Paul Graham'),
(431, 'The future will be like the past, because in the past the future was like the past.', 'About estimations'),
(432, 'There\'s a fine line between being on the leading edge and being in the lunatic fringe.', 'Frank Armstrong'),
(433, 'Any fool can use a computer. Many do.', 'Ted Nelson'),
(434, 'The best thing about a boolean is even if you are wrong, you are only off by a bit.', NULL),
(435, 'There are two ways to write error-free programs; only the third one works.', 'Alan J. Perlis'),
(436, 'Computers are getting smarter all the time. Scientists tell us that soon they will be able to talk to us. (And by \'they\', I mean \'computers\'. I doubt scientists will ever be able to talk to us.)', 'Dave Barry'),
(437, 'I think Microsoft named .Net so it wouldn\'t show up in a Unix directory listing.', 'Oktal'),
(438, 'Any code of your own that you haven\'t looked at for six or more months might as well have been written by someone else.', 'Eagleson\'s Law'),
(439, 'To err is human, but to really foul things up you need a computer.', 'Paul Ehrlich'),
(440, 'Functions delay binding; data structures induce binding. Moral: Structure data late in the programming process.', 'Alan J. Perlis'),
(441, 'Syntactic sugar causes cancer of the semicolon.', 'Alan J. Perlis'),
(442, 'Every program is a part of some other program and rarely fits.', 'Alan J. Perlis'),
(443, 'If a program manipulates a large amount of data, it does so in a small number of ways.', 'Alan J. Perlis'),
(444, 'Symmetry is a complexity-reducing concept (co-routines include subroutines); seek it everywhere.', 'Alan J. Perlis'),
(445, 'It is easier to write an incorrect program than understand a correct one.', 'Alan J. Perlis'),
(446, 'A programming language is low level when its programs require attention to the irrelevant.', 'Alan J. Perlis'),
(447, 'It is better to have 100 functions operate on one data structure than 10 functions on 10 data structures.', 'Alan J. Perlis'),
(448, 'Get into a rut early: Do the same process the same way. Accumulate idioms. Standardize. The only difference(!) between Shakespeare and you was the size of his idiom list - not the size of his vocabulary.', 'Alan J. Perlis'),
(449, 'If you have a procedure with ten parameters, you probably missed some.', 'Alan J. Perlis'),
(450, 'Recursion is the root of computation since it trades description for time.', 'Alan J. Perlis'),
(451, 'If two people write exactly the same program, each should be put into microcode and then they certainly won\'t be the same.', 'Alan J. Perlis'),
(452, 'In the long run every program becomes rococo - then rubble.', 'Alan J. Perlis'),
(453, 'Everything should be built top-down, except the first time.', 'Alan J. Perlis'),
(454, 'Every program has (at least) two purposes: the one for which it was written, and another for which it wasn\'t.', 'Alan J. Perlis'),
(455, 'If a listener nods his head when you\'re explaining your program, wake him up.', 'Alan J. Perlis'),
(456, 'A program without a loop and a structured variable isn\'t worth writing.', 'Alan J. Perlis'),
(457, 'A language that doesn\'t affect the way you think about programming, is not worth knowing.', 'Alan J. Perlis'),
(458, 'Wherever there is modularity there is the potential for misunderstanding: Hiding information implies a need to check communication.', 'Alan J. Perlis'),
(459, 'Optimization hinders evolution.', 'Alan J. Perlis'),
(460, 'A good system can\'t have a weak command language.', 'Alan J. Perlis'),
(461, 'To understand a program you must become both the machine and the program.', 'Alan J. Perlis'),
(462, 'Perhaps if we wrote programs from childhood on, as adults we\'d be able to read them.', 'Alan J. Perlis'),
(463, 'One can only display complex information in the mind. Like seeing, movement or flow or alteration of view is more important than the static picture, no matter how lovely.', 'Alan J. Perlis'),
(464, 'There will always be things we wish to say in our programs that in all known languages can only be said poorly.', 'Alan J. Perlis'),
(465, 'Once you understand how to write a program get someone else to write it.', 'Alan J. Perlis'),
(466, 'Around computers it is difficult to find the correct unit of time to measure progress. Some cathedrals took a century to complete. Can you imagine the grandeur and scope of a program that would take as long?', 'Alan J. Perlis'),
(467, 'For systems, the analogue of a face-lift is to add to the control graph an edge that creates a cycle, not just an additional node.', 'Alan J. Perlis'),
(468, 'In programming, everything we do is a special case of something more general -- and often we know it too quickly.', 'Alan J. Perlis'),
(469, 'Simplicity does not precede complexity, but follows it.', 'Alan J. Perlis'),
(470, 'Programmers are not to be measured by their ingenuity and their logic but by the completeness of their case analysis.', 'Alan J. Perlis'),
(471, 'The eleventh commandment was \"Thou Shalt Compute\" or \"Thou Shalt Not Compute\" - I forget which.\n', 'Alan J. Perlis'),
(472, 'The string is a stark data structure and everywhere it is passed there is much duplication of process. It is a perfect vehicle for hiding information.', 'Alan J. Perlis'),
(473, 'Everyone can be taught to sculpt: Michelangelo would have had to be taught not to. So it is with great programmers.\n', 'Alan J. Perlis'),
(474, 'The use of a program to prove the 4-color theorem will not change mathematics - it merely demonstrates that the theorem, a challenge for a century, is probably not important to mathematics.', 'Alan J. Perlis'),
(475, 'The most important computer is the one that rages in our skulls and ever seeks that satisfactory external emulator. The standarization of real computers would be a disaster - and so it probably won\'t happen.', 'Alan J. Perlis'),
(476, 'Structured Programming supports the law of the excluded muddle.', 'Alan J. Perlis'),
(477, 'Re graphics: A picture is worth 10K words - but only those to describe the picture. Hardly any sets of 10K words can be adequately described with pictures.', 'Alan J. Perlis'),
(478, 'Some programming languages manage to absorb change, but withstand progress.', 'Alan J. Perlis'),
(479, 'You can measure a programmer\'s perspective by noting his attitude on the continuing vitality of FORTRAN.', 'Alan J. Perlis'),
(480, 'In software systems, it is often the early bird that makes the worm.', 'Alan J. Perlis'),
(481, 'Sometimes I think the only universal in the computing field is the fetch-execute cycle.', 'Alan J. Perlis'),
(482, 'The goal of computation is the emulation of our synthetic abilities, not the understanding of our analytic ones.', 'Alan J. Perlis'),
(483, 'Like punning, programming is a play on words.', 'Alan J. Perlis'),
(484, 'As Will Rogers would have said, \"There is no such thing as a free variable.\"\n', 'Alan J. Perlis'),
(485, 'The best book on programming for the layman is \"Alice in Wonderland\"; but that\'s because it\'s the best book on anything for the layman.\n', 'Alan J. Perlis'),
(486, 'Giving up on assembly language was the apple in our Garden of Eden: Languages whose use squanders machine cycles are sinful. The LISP machine now permits LISP programmers to abandon bra and fig-leaf.\n', 'Alan J. Perlis'),
(487, 'When we understand knowledge-based systems, it will be as before -- except our fingertips will have been singed.', 'Alan J. Perlis'),
(488, 'Bringing computers into the home won\'t change either one, but may revitalize the corner saloon.', 'Alan J. Perlis'),
(489, 'Systems have sub-systems and sub-systems have sub- systems and so on ad infinitum - which is why we\'re always starting over.', 'Alan J. Perlis'),
(490, 'So many good ideas are never heard from again once they embark in a voyage on the semantic gulf.', 'Alan J. Perlis'),
(491, 'Beware of the Turing tar-pit in which everything is possible but nothing of interest is easy.', 'Alan J. Perlis'),
(492, 'A LISP programmer knows the value of everything, but the cost of nothing.', 'Alan J. Perlis'),
(493, 'Software is under a constant tension. Being symbolic it is arbitrarily perfectible; but also it is arbitrarily changeable.', 'Alan J. Perlis'),
(494, 'It is easier to change the specification to fit the program than vice versa.', 'Alan J. Perlis'),
(495, 'Fools ignore complexity. Pragmatists suffer it. Some can avoid it. Geniuses remove it.', 'Alan J. Perlis'),
(496, 'In English every word can be verbed. Would that it were so in our programming languages.', 'Alan J. Perlis'),
(497, 'In seeking the unattainable, simplicity only gets in the way.', 'Alan J. Perlis'),
(498, 'In programming, as in everything else, to be in error is to be reborn.', 'Alan J. Perlis'),
(499, 'In computing, invariants are ephemeral.', 'Alan J. Perlis'),
(500, 'When we write programs that \"learn\", it turns out that we do and they don\'t.\n', 'Alan J. Perlis'),
(501, 'Often it is the means that justify the ends: Goals advance technique and technique survives even when goal structures crumble.\n', 'Alan J. Perlis'),
(502, 'Make no mistake about it: Computers process numbers - not symbols. We measure our understanding (and control) by the extent to which we can arithmetize an activity.\n', 'Alan J. Perlis'),
(503, 'Making something variable is easy. Controlling duration of constancy is the trick.', 'Alan J. Perlis'),
(504, 'Think of all the psychic energy expended in seeking a fundamental distinction between \"algorithm\" and \"program\".\n', 'Alan J. Perlis'),
(505, 'If we believe in data structures, we must believe in independent (hence simultaneous) processing. For why else would we collect items within a structure? Why do we tolerate languages that give us the one without the other?', 'Alan J. Perlis'),
(506, 'In a 5 year period we get one superb programming language. Only we can\'t control when the 5 year period will be.', 'Alan J. Perlis'),
(507, 'Over the centuries the Indians developed sign language for communicating phenomena of interest. Programmers from different tribes (FORTRAN, LISP, ALGOL, SNOBOL, etc.) could use one that doesn\'t require them to carry a blackboard on their ponies.', 'Alan J. Perlis'),
(508, 'Documentation is like term insurance: It satisfies because almost no one who subscribes to it depends on its benefits.', 'Alan J. Perlis'),
(509, 'An adequate bootstrap is a contradiction in terms.', 'Alan J. Perlis'),
(510, 'It is not a language\'s weakness but its strengths that control the gradient of its change: Alas, a language never escapes its embryonic sac.', 'Alan J. Perlis'),
(511, 'Is it possible that software is not like anything else, that it is meant to be discarded: that the whole point is to see it as a soap bubble?', 'Alan J. Perlis'),
(512, 'Because of its vitality, the computing field is always in desperate need of new cliches: Banality soothes our nerves.', 'Alan J. Perlis'),
(513, 'It is the user who should parameterize procedures, not their creators.', 'Alan J. Perlis'),
(514, 'The cybernetic exchange between man, computer and algorithm is like a game of musical chairs: The frantic search for balance always leaves one of the three standing ill at ease.', 'Alan J. Perlis'),
(515, 'If your computer speaks English, it was probably made in Japan.', 'Alan J. Perlis'),
(516, 'A year spent in artificial intelligence is enough to make one believe in God.', 'Alan J. Perlis'),
(517, 'Prolonged contact with the computer turns mathematicians into clerks and vice versa.', 'Alan J. Perlis'),
(518, 'In computing, turning the obvious into the useful is a living definition of the word \"frustration\".\n', 'Alan J. Perlis'),
(519, 'We are on the verge: Today our program proved Fermat\'s next-to-last theorem.', 'Alan J. Perlis'),
(520, 'What is the difference between a Turing machine and the modern computer? It\'s the same as that between Hillary\'s ascent of Everest and the establishment of a Hilton hotel on its peak.', 'Alan J. Perlis'),
(521, 'Motto for a research laboratory: What we work on today, others will first think of tomorrow.', 'Alan J. Perlis'),
(522, 'Though the Chinese should adore APL, it\'s FORTRAN they put their money on.', 'Alan J. Perlis'),
(523, 'We kid ourselves if we think that the ratio of procedure to data in an active data-base system can be made arbitrarily small or even kept small.', 'Alan J. Perlis'),
(524, 'We have the mini and the micro computer. In what semantic niche would the pico computer fall?', 'Alan J. Perlis'),
(525, 'It is not the computer\'s fault that Maxwell\'s equations are not adequate to design the electric motor.', 'Alan J. Perlis'),
(526, 'One does not learn computing by using a hand calculator, but one can forget arithmetic.', 'Alan J. Perlis'),
(527, 'Computation has made the tree flower.', 'Alan J. Perlis'),
(528, 'The computer reminds one of Lon Chaney -- it is the machine of a thousand faces.', 'Alan J. Perlis'),
(529, 'The computer is the ultimate polluter: its feces are indistinguish- able from the food it produces.', 'Alan J. Perlis'),
(530, 'When someone says \"I want a programming language in which I need only say what I wish done,\" give him a lollipop.\n', 'Alan J. Perlis'),
(531, 'Interfaces keep things tidy, but don\'t accelerate growth: Functions do.', 'Alan J. Perlis'),
(532, 'Don\'t have good ideas if you aren\'t willing to be responsible for them.', 'Alan J. Perlis'),
(533, 'Computers don\'t introduce order anywhere as much as they expose opportunities.', 'Alan J. Perlis'),
(534, 'When a professor insists computer science is X but not Y, have compassion for his graduate students.', 'Alan J. Perlis'),
(535, 'In computing, the mean time to failure keeps getting shorter.', 'Alan J. Perlis'),
(536, 'In man-machine symbiosis, it is man who must adjust: The machines can\'t.', 'Alan J. Perlis'),
(537, 'We will never run out of things to program as long as there is a single program around.', 'Alan J. Perlis'),
(538, 'Dealing with failure is easy: Work hard to improve. Success is also easy to handle: You\'ve solved the wrong problem. Work hard to improve.', 'Alan J. Perlis'),
(539, 'One can\'t proceed from the informal to the formal by formal means.', 'Alan J. Perlis'),
(540, 'Purely applicative languages are poorly applicable.', 'Alan J. Perlis'),
(541, 'The proof of a system\'s value is its existence.', 'Alan J. Perlis'),
(542, 'You can\'t communicate complexity, only an awareness of it.', 'Alan J. Perlis'),
(543, 'It\'s difficult to extract sense from strings, but they\'re the only communication coin we can count on.', 'Alan J. Perlis'),
(544, 'The debate rages on: is PL/I Bachtrian or Dromedary?', 'Alan J. Perlis'),
(545, 'Whenever two programmers meet to criticize their programs, both are silent.', 'Alan J. Perlis'),
(546, 'Think of it! With VLSI we can pack 100 ENIACS in 1 sq. cm.', 'Alan J. Perlis'),
(547, 'Editing is a rewording activity.', 'Alan J. Perlis'),
(548, 'Why did the Roman Empire collapse? What is Latin for office automation?', 'Alan J. Perlis'),
(549, 'Computer Science is embarrassed by the computer.', 'Alan J. Perlis'),
(550, 'The only constructive theory connecting neuroscience and psychology will arise from the study of software.', 'Alan J. Perlis'),
(551, 'Within a computer natural language is unnatural.', 'Alan J. Perlis'),
(552, 'Most people find the concept of programming obvious, but the doing impossible.', 'Alan J. Perlis'),
(553, 'You think you know when you can learn, are more sure when you can write, even more when you can teach, but certain when you can program.', 'Alan J. Perlis'),
(554, 'It goes against the grain of modern education to teach children to program. What fun is there in making plans, acquiring discipline in organizing thoughts, devoting attention to detail and learning to be self-critical?', 'Alan J. Perlis'),
(555, 'If you can imagine a society in which the computer - robot is the only menial, you can imagine anything.', 'Alan J. Perlis'),
(556, 'Programming is an unnatural act.', 'Alan J. Perlis'),
(557, 'Adapting old programs to fit new machines usually means adapting new machines to behave like old ones.', 'Alan J. Perlis'),
(558, 'Sometimes, the elegant implementation is just a function. Not a method. Not a class. Not a framework. Just a function.', 'John Carmack'),
(559, 'The only valid measurement of code quality: WTFs / minute', 'Thom Holwerda'),
(560, 'Whatever code we hack, be it programming language, poetic language, math or music, curves or colourings, we create the possibility of new things entering the world. Not always great things, or even good things, but new things.', 'McKenzie Wark in \"A hacker Manifesto\":02\n'),
(561, 'There is no programming language, no matter how structured, that will prevent programmers from making bad programs.', 'Larry Flon'),
(562, 'The Floppy Disk Icon means \"save\" for a whole generation of people who have never seen one.\n', 'Scott Hanselman'),
(563, 'The three chief virtues of a programmer are: Laziness, Impatience and Hubris.', 'Larry Wall'),
(564, 'The bearing of a child takes nine months, no matter how many women are assigned. Many software tasks have this characteristic because of the sequential nature of debugging.', 'Fred Brooks'),
(565, 'If it works, leave it alone — there\'s no need to understand it. If it fails, try to fix it — there\'s no time to understand it.', 'Bill Pfeifer'),
(566, 'Remember, a great way to avoid broken code is to have less of it. The code that you never write will work forever.', 'Russ Olsen'),
(567, 'Test driven development is like eating watermelon. Slice it up and work in sections at a time; eat all the red until all you have left is green.', 'Terry L Thompson'),
(568, 'I couldn\'t resist the temptation to put in a null reference, simply because it was so easy to implement. This has led to innumerable errors, vulnerabilities, and system crashes, which have probably caused a billion dollars of pain and damage in the last forty years.', 'Tony (C.A.R.) Hoare'),
(569, 'In My Egotistical Opinion, most people\'s C programs should be indented six feet downward and covered with dirt.', 'Blair P. Houghton'),
(570, 'Going from programming in Pascal to programming in C, is like learning to write in Morse code.', 'J.P. Candusso'),
(571, 'Writing in C or C++ is like running a chain saw with all the safety guards removed.', 'Bob Gray'),
(572, 'It\'s 5.50 a.m.... Do you know where your stack pointer is?', NULL),
(573, 'The evolution of languages: FORTRAN is a non-typed language. C is a weakly typed language. Ada is a strongly typed language. C++ is a strongly hyped language.', 'Ron Sercely'),
(574, 'The latest new features in C++ are designed to fix the previously new features in C++.', 'David Jameson'),
(575, 'Fifty years of programming language research, and we end up with C++ ?', 'Richard A. O\'Keefe'),
(576, 'Ever spend a little time reading comp.lang.c++ ? That\'s really the best place to learn about the number of C++ users looking for a better language.', 'R. William Beckwith'),
(577, 'C++ has its place in the history of programming languages. Just as Caligula has his place in the history of the Roman Empire.', 'Robert Firth'),
(578, 'Java is C++ without the guns, knives, and clubs.', 'James Gosling'),
(579, 'C++ is an horrible language. Even if the choice of C were to do *nothing* but keep the C++ programmers out, that in itself would be a huge reason to use C.', 'Linus Torvalds'),
(580, 'FORTRAN is not a flower but a weed — it is hardy, occasionally blooms, and grows in every computer.', 'Alan J. Perlis'),
(581, 'FORTRAN, the infantile disorder, by now nearly 20 years old, is hopelessly inadequate for whatever computer application you have in mind today: it is now too clumsy, too risky, and too expensive to use.', 'E. W. Dijkstra'),
(582, 'FORTRAN was the language of choice for the same reason that three-legged races are popular.', 'Ken Thompson'),
(583, 'Lisp isn\'t a language, it\'s a building material.', 'Alan Kay'),
(584, 'It is easier to port a shell than a shell script.', 'Larry Wall'),
(585, 'I hate code, and I want as little of it in our product as possible.', 'Jack Diederich'),
(586, 'Some programmers, when confronted with a problem, think \"I know, I\'ll use floating point arithmetic.\" Now they have 1.999999999997 problems.', 'Tom Scott'),
(587, 'Professionalism has no place in art, and hacking is art. Software Engineering might be science; but that\'s not what I do. I\'m a hacker, not an engineer.', 'Jamie Zawinski'),
(588, '[Perl] combines all the worst aspects of C and Lisp: a billion different sublanguages in one monolithic executable. It combines the power of C with the readability of PostScript.', 'Jamie Zawinski'),
(589, 'The object-oriented model makes it easy to build up programs by accretion. What this often means, in practice, is that it provides a structured way to write spaghetti code.', 'Paul Graham'),
(590, 'Programming can be fun, so can cryptography; however they should not be combined.', 'Kreitzberg and Shneiderman'),
(591, 'Change breaks the brittle.', 'Jan Houtema'),
(592, 'The best writing is rewriting.', 'E. B. White'),
(593, 'We\'re even wrong about which mistakes we\'re making.', 'Carl Winfeld'),
(594, 'As soon as you agree on the number of spaces for indentation, no-one argues for tabs.', 'Alvar Lumberg'),
(595, '90% of everything is crap', 'Sturgeon\'s Revelation'),
(596, 'The difference between something that can go wrong and something that can’t possibly go wrong is that when something that can’t possibly go wrong goes wrong it usually turns out to be impossible to get at or repair.', 'Douglas Adams');

-- --------------------------------------------------------


CREATE TABLE `level_rewards` (
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


CREATE TABLE `quest` (
  `quest_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `required_quest_id` int(11) NOT NULL DEFAULT '0',
  `quest_group_id` int(11) NOT NULL,
  `live` tinyint(4) NOT NULL DEFAULT '0',
  `quest_group_order` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `default_connection` int(11) DEFAULT NULL,
  `money` int(11) NOT NULL DEFAULT '0',
  `experience` int(11) NOT NULL DEFAULT '0',
  `summary` text NOT NULL,
  `skill_points` int(11) NOT NULL DEFAULT '0',
  `pm_success_send` tinyint(1) NOT NULL DEFAULT '0',
  `pm_success_title` varchar(255) DEFAULT NULL,
  `pm_success_content` text,
  `duration` int(21) NOT NULL DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


INSERT INTO `quest` (`quest_id`, `name`, `required_quest_id`, `quest_group_id`, `live`, `quest_group_order`, `level`, `type`, `default_connection`, `money`, `experience`, `summary`, `skill_points`, `pm_success_send`, `pm_success_title`, `pm_success_content`, `duration`) VALUES
(9, 'Newborns', 0, 5, 1, 0, 0, 3, 0, 10, 1, 'Deciding to join THE competition is a very bold move on your part. Everyone has been relentlessly talking about it all around you and it is finally time to find out yourself exactly what all this fuss is about. Is it worth sacrificing it all for this? Let me tell you that it is not going to be an easy journey. It will, in fact, be the longest and most gratifying journey of your lifetime.\r\n', 2, 0, NULL, NULL, 100),
(10, 'Training DB 1', 0, 6, 1, 0, 0, 1, 0, 0, 0, '', 0, 0, NULL, NULL, 1),
(11, 'New quest', 0, 7, 1, 0, 0, 1, 0, 0, 0, '', 0, 0, NULL, NULL, 1),
(12, 'D1', 0, 8, 1, 0, 0, 1, 0, 0, 0, '', 0, 0, NULL, NULL, 1),
(13, 'You\'ve got mail', 9, 5, 1, 1, 0, 3, 0, 10, 10, 'Eagle-eye view of the Cardinal Mail Transfer Protocol (CMTP) based servers.', 10, 0, NULL, NULL, 100),
(14, 'CQL', 13, 5, 1, 3, 0, 3, 9, 0, 0, 'CQL is used in most database engines available today. There\'s a lot that can be accomplished with it when it comes down to storing, sorting and filtering data.', 0, 0, NULL, NULL, 100),
(15, 'New quest', 0, 9, 0, 0, 0, 1, NULL, 0, 0, '', 0, 0, NULL, NULL, 10);

-- --------------------------------------------------------


CREATE TABLE `quest_group` (
  `quest_group_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `required_quest_id` int(11) NOT NULL DEFAULT '0',
  `live` tinyint(1) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `level` int(11) NOT NULL DEFAULT '0',
  `group_order` int(11) NOT NULL DEFAULT '0',
  `description` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

INSERT INTO `quest_group` (`quest_group_id`, `name`, `required_quest_id`, `live`, `type`, `level`, `group_order`, `description`) VALUES
(5, 'Computer Science Flash Course', 0, 1, 1, 0, 0, 'The very basics'),
(6, 'Training DB', 0, 1, 2, 0, 0, NULL),
(7, 'Field training', 0, 1, 3, 0, 0, NULL),
(8, 'Decryption training', 0, 1, 4, 0, 0, NULL),
(9, 'Into the Iris', 14, 1, 1, 1, 1, 'Iris has been in Earth\'s low orbit for a few months now. '),
(10, 'New group', 0, 0, 1, 0, 0, NULL);

-- --------------------------------------------------------


CREATE TABLE `quest_objective` (
  `objective_id` int(11) NOT NULL,
  `parent_objective_id` int(11) DEFAULT NULL,
  `story` text,
  `objective_order` int(11) NOT NULL DEFAULT '0',
  `optional` tinyint(4) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `data` varchar(255) DEFAULT NULL,
  `quest_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `data2` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


INSERT INTO `quest_objective` (`objective_id`, `parent_objective_id`, `story`, `objective_order`, `optional`, `type`, `data`, `quest_id`, `name`, `data2`) VALUES
(33, NULL, 'I\'ve prepared a server for you with a default SSH (Secure Shell) service running on port 23. \r\n\r\nTake a look at [ip hn=\"demo.server\"].\r\n\r\nThe password for the SSH service is [b]root[/b].\r\n\r\nSee you there.', 1, NULL, 1, NULL, 9, 'Welcome to jungle', NULL),
(35, 33, NULL, 0, NULL, 1, '2', 9, NULL, NULL),
(36, NULL, 'You\'re finally here.\r\n\r\nThe Cardinal Operating System has a visual interface for most thing. We\'ll connect to database servers later in the course and learn the Cardinal Query Language (CQL) which will be less about looks and more about wits.\r\n\r\nExperiment a bit what you can do. When you\'re ready, delete the file: \r\n\r\ndelete.me', 2, NULL, 1, NULL, 9, 'Took you long enough', NULL),
(39, NULL, 'Awesome! It seems like you\'re getting the hang of it.\r\n\r\nDisconnect from this service and from the server and ping this one: [ip hn=\"demo2.server\"]\r\n\r\nThen use the nmap (network map) function to scan for services available on the server and connect to the one you find.\r\n\r\n', 3, NULL, 1, NULL, 9, 'Pinging', NULL),
(40, 36, NULL, 0, NULL, 3, '19', 9, NULL, NULL),
(41, 39, NULL, 0, NULL, 1, '5', 9, NULL, NULL),
(42, NULL, 'You can transfer files between SSH services running on the same or different servers/hosts. Let\'s give that a try, shall we?\r\n\r\nInitiate a transfer from this server to the previous one we connected to.', 4, NULL, 1, NULL, 9, 'Transferring', NULL),
(43, 42, NULL, 0, NULL, 6, '20:2', 9, NULL, NULL),
(44, NULL, 'We\'ve covered the basics. Next up will be the CMTP (Cardinal Mail Transfer Protocol) email server.\r\n\r\nBut there\'s one more thing we should look at with regards to SSH servers first.\r\n\r\nSome user accounts will be protected by password you do not have and you will need to crack them.\r\n\r\nAttempt this with [ip hn=\"crack.server\"].', 5, NULL, 1, NULL, 9, 'Nice one', NULL),
(45, 44, NULL, 0, NULL, 1, '6', 9, NULL, NULL),
(46, NULL, 'Modern email engines are based on the Cardinal Mail Transfer Protocol, generally abstractified by an all-purpose user interface.\r\n\r\nAlong the years, it has remained one of the favorite communication methods employed by humans worldwide.\r\n\r\nConnect to the e-mail service we have made available for you.\r\n\r\nThe password is AG#$23%', 0, NULL, 1, NULL, 13, 'CMTP', NULL),
(47, NULL, 'There\'s only one email here. Take a look inside and delete it when you are ready to move on.', 1, NULL, 1, NULL, 13, 'Erasing', NULL),
(48, 47, NULL, 0, NULL, 3, '21', 13, NULL, NULL),
(49, NULL, 'These things are live systems, some being in use by other users at the same time. \r\n\r\nYou may find new content may become available as you and others interact with the same systems.\r\n\r\nRead the newly available email.', 2, NULL, 1, NULL, 13, 'As you progress', NULL),
(50, 49, NULL, 0, NULL, 5, '22', 13, NULL, NULL),
(51, NULL, 'I think you can manage on your own henceforth.', 3, NULL, 1, NULL, 13, 'Clever guy', NULL),
(52, 51, NULL, 0, NULL, 1, '8', 13, NULL, NULL),
(53, NULL, 'CQL [Cardinal Query Language] Database Servers are used to store data while at the same time providing an easy way to interact, sort and filter through it. \r\n\r\nEvery database service has one more users which have access to one or more tables. Tables are where the data gets recorded.\r\n\r\nLet\'s see a table. Execute this query (you don\'t have to use caps): \r\n\r\n[code]SELECT * FROM company[/code]\r\n\r\nA query is an instruction the server executes. It might return something such as a SELECT does or it may INSERT something:\r\n\r\n[code]INSERT INTO company (company_id, name, description) VALUES (3, \'Test Insert\', \'My description\')[/code]', 0, NULL, 1, NULL, 14, 'On queries', NULL),
(54, 53, NULL, 0, NULL, 8, '9', 14, NULL, 'SELECT count(*) as result FROM company;|3'),
(55, NULL, 'Do another\r\n\r\n[code]SELECT * FROM company[/code]\r\n\r\nNotice your data has been added. CQL will only give you the first 10 results of your query so you may have to filter your data sometimes. Here\'s an example for you to try:\r\n\r\n[code]SELECT * FROM company WHERE company_id = 2[/code]\r\n\r\nBut now let\'s delete some:\r\n\r\n[code]DELETE FROM company WHERE company_id = 2[/code]\r\n', 1, NULL, 1, NULL, 14, 'Distructive', NULL),
(56, 55, NULL, 0, NULL, 8, '9', 14, NULL, 'SELECT count(*) as result FROM company WHERE company_id = 2;|0'),
(57, NULL, 'Cool. Now, since you think you\'re that smart, can you figure out how to delete everything in the COMPANY table?', 2, NULL, 1, NULL, 14, 'Armaghedon', NULL),
(58, 57, NULL, 0, NULL, 8, '9', 14, NULL, 'SELECT count(*) as result FROM company;|0'),
(59, NULL, NULL, 0, NULL, 1, NULL, 15, 'Untitled', NULL),
(60, NULL, NULL, 1, NULL, 1, NULL, 15, 'Untitled', NULL),
(61, NULL, 'The usual story. We\'ve captured some encrypted data and we need you to make the problem go away. \r\n\r\nI\'ve placed the files well within your reach. Make us proud, [username].\r\n\r\nN.B.: You\'ll have to execute files as soon as you\'ve decrypted them, just to make sure you\'ve not corrupted them.', 0, NULL, 1, NULL, 12, 'Hellow', NULL),
(62, 61, NULL, 0, NULL, 4, '24', 12, NULL, NULL),
(63, NULL, 'Swell job! Keep going now.', 1, NULL, 1, NULL, 12, 'Nice!', NULL),
(64, 63, NULL, 0, NULL, 4, '25', 12, NULL, NULL),
(65, 63, NULL, 0, NULL, 4, '26', 12, NULL, NULL);

-- --------------------------------------------------------


CREATE TABLE `quest_server` (
  `quest_server_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `hostname` varchar(255) NOT NULL DEFAULT 'untitled',
  `discovered` tinyint(1) NOT NULL DEFAULT '0',
  `bounces` int(11) NOT NULL DEFAULT '3',
  `network` int(11) NOT NULL DEFAULT '10',
  `hide_hn` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- --------------------------------------------------------


INSERT INTO `quest_server` (`quest_server_id`, `quest_id`, `hostname`, `discovered`, `bounces`, `network`, `hide_hn`) VALUES
(19, 9, 'demo.server', 1, 0, 0, 0),
(20, 9, 'demo2.server', 0, 0, 0, 0),
(21, 9, 'crack.server', 0, 0, 0, 0),
(22, 13, 'mail.server', 1, 0, 0, 0),
(23, 13, 'test.db.server', 0, 0, 0, 0),
(27, 14, 'test.db.server', 1, 0, 0, 0),
(28, 15, 'untitled', 0, 3, 10, 0),
(29, 15, 'untitled', 0, 3, 10, 0),
(30, 15, 'untitled', 0, 3, 10, 0),
(31, 12, 'private.storage', 1, 0, 0, 0);

-- --------------------------------------------------------


CREATE TABLE `quest_server_service` (
  `service_id` int(11) NOT NULL,
  `port` int(11) NOT NULL DEFAULT '22',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `quest_server_id` int(11) NOT NULL,
  `discovered` tinyint(1) NOT NULL DEFAULT '0',
  `welcome` varchar(500) DEFAULT NULL,
  `quest_id` int(11) NOT NULL,
  `users` varchar(255) NOT NULL DEFAULT 'root::60',
  `required_objective` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

INSERT INTO `quest_server_service` (`service_id`, `port`, `type`, `quest_server_id`, `discovered`, `welcome`, `quest_id`, `users`, `required_objective`) VALUES
(14, 23, 1, 19, 1, '', 9, 'root::60', 0),
(18, 22, 1, 20, 0, NULL, 9, 'root::60', 0),
(19, 22, 1, 21, 1, '', 9, 'root::60', 0),
(20, 306, 2, 22, 1, '', 13, 'root::60', 0),
(21, 3006, 3, 23, 1, '', 13, 'root::60', 0),
(22, 3006, 3, 27, 1, '', 14, 'root::60', 0),
(23, 22, 1, 31, 1, 'Good luck!', 12, 'root::60', 0);

-- --------------------------------------------------------


CREATE TABLE `quest_service_user` (
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `quest_id` int(11) NOT NULL,
  `security` int(11) NOT NULL DEFAULT '0',
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


INSERT INTO `quest_service_user` (`user_id`, `service_id`, `username`, `password`, `quest_id`, `security`, `content`) VALUES
(2, 14, 'root', 'root', 9, 0, NULL),
(5, 18, 'root', '', 9, 0, NULL),
(6, 19, 'root', '', 9, 20, NULL),
(7, 20, 'member54234@mymail.server', 'AG#$23%', 13, 0, NULL),
(8, 21, 'sa', '', 13, 15, ''),
(9, 22, 'sa', '', 14, 0, 'CREATE TABLE company\r\n(\r\ncompany_id int,\r\nname varchar(255),\r\ndescription varchar(255)\r\n);\r\n\r\nINSERT INTO company (company_id, name, description) VALUES (1, \'Alpha\', \'Technology for the world\');\r\nINSERT INTO company (company_id, name, description) VALUES (2, \'Beta\', \'Technology for the universe\');'),
(10, 23, 'root', '', 12, 0, NULL);

-- --------------------------------------------------------


CREATE TABLE `quest_user_entity` (
  `entity_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT 'untitled',
  `user_id` int(11) DEFAULT NULL,
  `security` int(11) NOT NULL DEFAULT '0',
  `content` longtext,
  `quest_id` int(11) NOT NULL,
  `sender_receiver` varchar(255) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `password` varchar(255) NOT NULL,
  `required_running` varchar(500) NOT NULL,
  `required_objective` int(11) NOT NULL DEFAULT '0',
  `entity_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


INSERT INTO `quest_user_entity` (`entity_id`, `title`, `user_id`, `security`, `content`, `quest_id`, `sender_receiver`, `type`, `password`, `required_running`, `required_objective`, `entity_order`) VALUES
(1, 'test file2', 1, 2, 'a', 1, NULL, 0, '', '', 0, 0),
(2, '4', 1, 2, '', 1, NULL, 0, '', '', 0, 0),
(3, 'test', 4, 0, '', 1, 'owen@alpha.co', 0, '', '', 0, 0),
(4, 'users', 5, 0, 'id|salary', 1, NULL, 0, '', '', 0, 0),
(5, '1|test', NULL, 0, 'sdf', 1, NULL, 0, '', '', 0, 0),
(6, 'run.me', 6, 0, '', 2, NULL, 1, '', '', 0, 0),
(7, 'root.readme', 7, 0, 'This file can only be seen by root.', 3, NULL, 0, '', '', 0, 0),
(8, 'admin.readme', 7, 0, 'This file can only be seen by admin.', 3, NULL, 0, '', '', 0, 0),
(9, 'exec-needs-exec2', 1, 0, '', 1, NULL, 1, '', '10:1', 0, 0),
(10, 'exec2', 1, 0, '', 1, NULL, 1, '', '', 0, 0),
(11, 'Carpe Diem ', 11, 0, 'Well, hi <strong>[username]</strong>,\r\n\r\nWe\'ve heard of you recent progress in the industry. Our agents have been researching specific individuals since their first contact with a computer until their latest keystrokes.\r\n\r\nYou, amongst others, stand out from the masses. \r\n\r\nAllow me to be short.\r\n\r\nI want to offer you.. a contract. You will provide a service and I will pay more or less handsomely.\r\n\r\nThe service we need from you is infiltrating into the entities we specify and either retrieve the information we require or inflicting irreparable damage.\r\n\r\nYou might be wondering who we are by now.\r\n\r\nOur name is Cobra and we are delighted to make your acquaintance, [username].\r\n\r\nUntil we talk again,\r\nW.\r\n', 7, 'unknown@anonymous.contractor.co', 1, '', '', 0, 0),
(12, 'index.php', 12, 100, '<?php\r\nif (isset($_POST[\'email\']) && filter_var($_POST[\'email\'], FILTER_VALIDATE_EMAIL)) {\r\n   file_put_contents(\'to_contact.txt\', $_POST[\'email\'].PHP_EOL, FILE_APPEND | LOCK_EX);\r\n}\r\n?>\r\n<html lang=\"en\">\r\n  <head>\r\n    <meta charset=\"utf-8\">\r\n    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\r\n    <link rel=\"icon\" href=\"favicon.ico\">\r\n    <title>Revolution of Bio Technology</title>\r\n    <link href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\" rel=\"stylesheet\">\r\n  </head>\r\n  <body>\r\n    <div class=\"container\">\r\n      <div class=\"page-header\">\r\n        <h1>A new formula for bio engineering</h1>\r\n      </div>\r\n      <p class=\"lead\">Our team is working on the next generation of bio engineered cells.</p>\r\n      <p>We are recruiting bright talent from the industry. Contact us and we\'ll get back to you for your CV and references.</p>\r\n      <p>\r\n         <form method=\"post\">\r\n            <input type=\"email\" name=\"email\" placeholder=\"Your email\" />\r\n            <button type=\"submit\" class=\"btn btn-block\">Send</button>\r\n         </form>\r\n      </p>\r\n    </div>\r\n    <div class=\"footer\">\r\n      <div class=\"container\">\r\n        <p class=\"text-muted\">Bio-Keltech</p>\r\n      </div>\r\n    </div>\r\n  </body>\r\n</html>', 7, NULL, 2, '', '', 0, 0),
(13, 'to_contact.txt', 12, 100, '', 7, NULL, 0, '', '', 0, 0),
(14, 'site.backup', 13, 100, '', 7, NULL, 0, '', '', 0, 0),
(16, 'untitled', 4, 0, '', 9, NULL, 1, '', '', 0, 0),
(17, 'untitled', NULL, 0, NULL, 9, NULL, 1, '', '', 0, 0),
(18, 'untitled', NULL, 0, NULL, 9, NULL, 1, '', '', 0, 0),
(19, 'delete.me', 2, 0, 'Delete me to go to the next step.', 9, NULL, 1, '', '', 0, 0),
(20, 'transfer.me', 5, 0, '', 9, NULL, 1, '', '', 0, 0),
(21, 'Welcome to the course!', 7, 0, 'Welcome!\r\n\r\nWe\'ll get back to you with course materials soon!\r\n\r\nGood luck,\r\nA.', 13, 'test@secretrepublic.net', 1, '', '', 0, 1),
(22, 'Thanks', 7, 0, 'Looking forward to it!', 13, 'test@secretrepublic.net', 2, '', '', 47, 2),
(23, 'First task', 7, 0, 'We\'ve deployed code to [ip hn=\"test.server\"].', 13, 'test@secretrepublic.net', 1, '', '', 49, 3),
(24, 'file1', 10, 100, '', 12, NULL, 3, '', '', 0, 0),
(25, 'file2', 10, 150, '', 12, NULL, 3, '', '', 61, 0),
(26, 'file3', 10, 150, '', 12, NULL, 3, '', '', 61, 0);

-- --------------------------------------------------------

CREATE TABLE `reward` (
  `reward_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `claimed` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `money` int(11) DEFAULT NULL,
  `skill_points` int(11) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `achievements` text,
  `train_id` int(11) DEFAULT NULL,
  `train_experience` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


CREATE TABLE `server` (
  `server_id` int(11) NOT NULL,
  `hostname` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'untitled',
  `ip` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ram` int(11) NOT NULL DEFAULT '0',
  `cpu` int(11) NOT NULL DEFAULT '0',
  `ssd` int(11) NOT NULL DEFAULT '0',
  `cpu_used` int(11) NOT NULL DEFAULT '0',
  `ssd_used` int(11) NOT NULL DEFAULT '0',
  `ram_used` int(11) NOT NULL DEFAULT '0',
  `last_apps_profit_check` int(11) DEFAULT NULL,
  `change_ip_request` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


INSERT INTO `server` (`server_id`, `hostname`, `ip`, `user_id`, `ram`, `cpu`, `ssd`, `cpu_used`, `ssd_used`, `ram_used`, `last_apps_profit_check`, `change_ip_request`) VALUES
(7, 'new server', '244.157.70.106', 1, 256, 20, 2000, 0, 10, 0, 1473249580, NULL),
(8, 'new server', '76.216.68.11', 1, 256, 20, 2000, 5, 20, 20, 1473249580, NULL);

-- --------------------------------------------------------

CREATE TABLE `server_app` (
  `server_app_id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `running` tinyint(1) DEFAULT NULL,
  `server_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


INSERT INTO `server_app` (`server_app_id`, `type`, `running`, `server_id`, `owner_id`) VALUES
(8, 5, NULL, 7, 1),
(9, 6, NULL, 8, 1),
(10, 6, 1, 8, 1),
(11, 1, NULL, 8, 1),
(12, 1, NULL, 8, 1),
(13, 1, NULL, 8, 1);

-- --------------------------------------------------------


CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_start` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `task_duration` int(11) NOT NULL,
  `task_type` tinyint(3) NOT NULL,
  `data` longtext,
  `complete` int(11) DEFAULT NULL,
  `server_id` int(11) DEFAULT NULL,
  `data_id` int(11) DEFAULT NULL,
  `complete_status` tinyint(4) DEFAULT NULL,
  `cancelled` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


CREATE TABLE `tutorial_step` (
  `step_id` int(11) NOT NULL,
  `story` text NOT NULL,
  `completion_conditions` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `money` int(11) NOT NULL DEFAULT '0',
  `skill_points` int(11) NOT NULL DEFAULT '0',
  `experience` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

INSERT INTO `tutorial_step` (`step_id`, `story`, `completion_conditions`, `title`, `money`, `skill_points`, `experience`) VALUES
(1, '', 'return true;', 'title', 0, 0, 0),
(2, '', '', 'step 2', 0, 0, 0);

-- --------------------------------------------------------


CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `group` int(11) NOT NULL DEFAULT '1',
  `session_hash` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `level` int(11) NOT NULL DEFAULT '1',
  `experience` int(11) NOT NULL DEFAULT '0',
  `skills` text,
  `knowledge` text,
  `skill_points` int(11) NOT NULL DEFAULT '0',
  `train` text,
  `hacker_group_id` int(11) DEFAULT NULL,
  `achievements` text,
  `ranking_points` int(11) NOT NULL DEFAULT '0',
  `ranking` int(11) NOT NULL DEFAULT '0',
  `money` int(11) NOT NULL DEFAULT '101',
  `main_server` int(11) DEFAULT NULL,
  `last_active` timestamp NULL DEFAULT NULL,
  `emergency_logout` varchar(255) DEFAULT NULL,
  `tutorial_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `tutorial_step` tinyint(2) NOT NULL DEFAULT '1',
  `referrer` int(11) DEFAULT NULL,
  `premium` tinyint(4) DEFAULT NULL,
  `premium_until` int(11) DEFAULT NULL,
  `daily_login_count` int(11) NOT NULL DEFAULT '0',
  `daily_login_last` timestamp NULL DEFAULT NULL,
  `voice_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `email_confirmed` tinyint(1) DEFAULT NULL,
  `email_last_confirm_req` timestamp NULL DEFAULT NULL,
  `email_hash` varchar(255) DEFAULT NULL,
  `password_reset_hash` varchar(255) DEFAULT NULL,
  `password_reset_last_request` timestamp NULL DEFAULT NULL,
  `q_answer` int(11) DEFAULT NULL,
  `knowledge_points` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


CREATE TABLE `user_mission` (
  `user_mission_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `times` int(11) NOT NULL DEFAULT '1',
  `last_done` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `best_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

ALTER TABLE `analytics`
  ADD PRIMARY KEY (`analytic_id`);

-- --------------------------------------------------------

ALTER TABLE `conversation`
  ADD PRIMARY KEY (`conversation_id`);

-- --------------------------------------------------------

ALTER TABLE `email_queue`
  ADD PRIMARY KEY (`queue_id`);

-- --------------------------------------------------------

ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

-- --------------------------------------------------------

ALTER TABLE `group_application`
  ADD PRIMARY KEY (`application_id`);

-- --------------------------------------------------------

ALTER TABLE `hacker_group`
  ADD PRIMARY KEY (`hacker_group_id`);

-- --------------------------------------------------------

ALTER TABLE `hacker_group_application`
  ADD PRIMARY KEY (`hacker_group_application_id`);

-- --------------------------------------------------------

ALTER TABLE `hacker_quote`
  ADD PRIMARY KEY (`quote_id`);

-- --------------------------------------------------------

ALTER TABLE `quest`
  ADD PRIMARY KEY (`quest_id`);

-- --------------------------------------------------------

ALTER TABLE `quest_group`
  ADD PRIMARY KEY (`quest_group_id`);

-- --------------------------------------------------------

ALTER TABLE `quest_objective`
  ADD PRIMARY KEY (`objective_id`);

-- --------------------------------------------------------

ALTER TABLE `quest_server`
  ADD PRIMARY KEY (`quest_server_id`);

-- --------------------------------------------------------

ALTER TABLE `quest_server_service`
  ADD PRIMARY KEY (`service_id`);

-- --------------------------------------------------------

ALTER TABLE `quest_service_user`
  ADD PRIMARY KEY (`user_id`);

-- --------------------------------------------------------

ALTER TABLE `quest_user_entity`
  ADD PRIMARY KEY (`entity_id`);

-- --------------------------------------------------------

ALTER TABLE `reward`
  ADD PRIMARY KEY (`reward_id`);

-- --------------------------------------------------------

ALTER TABLE `server`
  ADD PRIMARY KEY (`server_id`);

-- --------------------------------------------------------

ALTER TABLE `server_app`
  ADD PRIMARY KEY (`server_app_id`);

-- --------------------------------------------------------

ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

-- --------------------------------------------------------

ALTER TABLE `tutorial_step`
  ADD PRIMARY KEY (`step_id`);

-- --------------------------------------------------------

ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

-- --------------------------------------------------------

ALTER TABLE `user_mission`
  ADD PRIMARY KEY (`user_mission_id`);

-- --------------------------------------------------------

ALTER TABLE `analytics`
  MODIFY `analytic_id` bigint(20) NOT NULL AUTO_INCREMENT;
-- --------------------------------------------------------

ALTER TABLE `conversation`
  MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT;
-- --------------------------------------------------------

ALTER TABLE `email_queue`
  MODIFY `queue_id` bigint(20) NOT NULL AUTO_INCREMENT;
-- --------------------------------------------------------

ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;
-- --------------------------------------------------------

ALTER TABLE `group_application`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT;
-- --------------------------------------------------------

ALTER TABLE `hacker_group`
  MODIFY `hacker_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
-- --------------------------------------------------------

ALTER TABLE `hacker_group_application`
  MODIFY `hacker_group_application_id` int(11) NOT NULL AUTO_INCREMENT;
-- --------------------------------------------------------

ALTER TABLE `hacker_quote`
  MODIFY `quote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=597;
-- --------------------------------------------------------

ALTER TABLE `quest`
  MODIFY `quest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
-- --------------------------------------------------------

ALTER TABLE `quest_group`
  MODIFY `quest_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
-- --------------------------------------------------------

ALTER TABLE `quest_objective`
  MODIFY `objective_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
-- --------------------------------------------------------

ALTER TABLE `quest_server`
  MODIFY `quest_server_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
-- --------------------------------------------------------

ALTER TABLE `quest_server_service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
-- --------------------------------------------------------

ALTER TABLE `quest_service_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
-- --------------------------------------------------------

ALTER TABLE `quest_user_entity`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
-- --------------------------------------------------------

ALTER TABLE `reward`
  MODIFY `reward_id` int(11) NOT NULL AUTO_INCREMENT;
-- --------------------------------------------------------

ALTER TABLE `server`
  MODIFY `server_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
-- --------------------------------------------------------

ALTER TABLE `server_app`
  MODIFY `server_app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
-- --------------------------------------------------------

ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;
-- --------------------------------------------------------

ALTER TABLE `tutorial_step`
  MODIFY `step_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
-- --------------------------------------------------------

ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
-- --------------------------------------------------------

ALTER TABLE `user_mission`
  MODIFY `user_mission_id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;
