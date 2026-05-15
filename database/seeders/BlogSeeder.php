<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'SSC CGL 2025 Admit Card Released – Download Now',
                'short_description' => 'The Staff Selection Commission has released the SSC CGL 2025 Admit Card for Tier-I examination. Candidates can download from the official portal.',
                'content' => '<h2>SSC CGL 2025 Admit Card</h2><p>The Staff Selection Commission (SSC) has officially released the admit cards for the Combined Graduate Level (CGL) 2025 Tier-I examination. Candidates who have successfully registered for the exam can now download their admit cards from the official SSC website.</p><h3>Important Details</h3><ul><li><strong>Exam Name:</strong> SSC CGL 2025 Tier-I</li><li><strong>Exam Date:</strong> March 15-25, 2025</li><li><strong>Admit Card Status:</strong> Released</li><li><strong>Official Website:</strong> ssc.nic.in</li></ul><h3>How to Download</h3><ol><li>Visit the official SSC website</li><li>Click on "Admit Card" section</li><li>Enter your Registration Number and Date of Birth</li><li>Click "Download Admit Card"</li><li>Take a printout for exam day</li></ol><p>Candidates are advised to download their admit cards well in advance and verify all the details mentioned on it. In case of any discrepancy, contact the regional SSC office immediately.</p><h3>Important Instructions</h3><p>Candidates must carry a valid photo ID proof along with the admit card to the examination center. Electronic devices including mobile phones are strictly prohibited inside the exam hall.</p>',
                'category' => 'Admit Card',
                'publish_date' => '2025-02-15',
            ],
            [
                'title' => 'UPSC Civil Services 2025 Prelims Result Declared',
                'short_description' => 'UPSC has declared the Civil Services Preliminary Examination 2025 results. Check your result and cutoff marks here.',
                'content' => '<h2>UPSC CSE Prelims 2025 Result</h2><p>The Union Public Service Commission (UPSC) has declared the results of the Civil Services Preliminary Examination 2025. Candidates who appeared for the examination can check their results on the official UPSC website.</p><h3>Result Highlights</h3><ul><li><strong>Total Candidates Appeared:</strong> 5,85,000+</li><li><strong>Candidates Qualified:</strong> 14,500 (approx)</li><li><strong>General Category Cutoff:</strong> 98/200</li><li><strong>OBC Cutoff:</strong> 92/200</li><li><strong>SC Cutoff:</strong> 82/200</li></ul><h3>Next Steps</h3><p>Qualified candidates must now fill the Detailed Application Form (DAF) for the Mains examination. The last date for DAF submission is within 15 days of result declaration.</p><h3>Mains Examination Schedule</h3><p>The UPSC CSE Mains 2025 is scheduled to be held in September 2025. Candidates should start their preparation immediately to cover the vast syllabus.</p>',
                'category' => 'Results',
                'publish_date' => '2025-03-01',
            ],
            [
                'title' => 'IBPS PO 2025 Exam Date Announced – Complete Schedule',
                'short_description' => 'Institute of Banking Personnel Selection has announced the IBPS PO 2025 exam schedule. Get complete details about dates, pattern, and syllabus.',
                'content' => '<h2>IBPS PO 2025 Exam Schedule</h2><p>The Institute of Banking Personnel Selection (IBPS) has officially announced the examination schedule for Probationary Officers (PO) recruitment 2025. This is one of the most awaited banking exams in India.</p><h3>Exam Schedule</h3><ul><li><strong>Prelims Exam:</strong> October 12-19, 2025</li><li><strong>Mains Exam:</strong> November 29, 2025</li><li><strong>Interview:</strong> January-February 2026</li></ul><h3>Exam Pattern</h3><h4>Prelims (100 Marks, 60 Minutes)</h4><ul><li>English Language - 30 Questions</li><li>Quantitative Aptitude - 35 Questions</li><li>Reasoning Ability - 35 Questions</li></ul><h4>Mains (200 Marks, 180 Minutes)</h4><ul><li>Reasoning & Computer Aptitude - 45 Questions</li><li>English Language - 35 Questions</li><li>Data Analysis & Interpretation - 35 Questions</li><li>General/Economy/Banking Awareness - 40 Questions</li></ul><h3>Eligibility</h3><p>Candidates must hold a graduation degree from a recognized university. Age limit is 20-30 years with relaxation as per government norms.</p>',
                'category' => 'Exams',
                'publish_date' => '2025-01-20',
            ],
            [
                'title' => 'Railway RRB NTPC 2025 – 35,000+ Vacancies Announced',
                'short_description' => 'Indian Railways has announced a massive recruitment drive with over 35,000 vacancies through RRB NTPC 2025. Apply now before the deadline.',
                'content' => '<h2>RRB NTPC 2025 Recruitment</h2><p>The Railway Recruitment Boards (RRBs) across India have announced a massive recruitment drive for Non-Technical Popular Categories (NTPC) with over 35,000 vacancies. This is the largest railway recruitment in recent years.</p><h3>Vacancy Details</h3><ul><li><strong>Total Vacancies:</strong> 35,281</li><li><strong>Graduate Level Posts:</strong> Station Master, Goods Guard, Senior Clerk</li><li><strong>12th Level Posts:</strong> Junior Clerk, Accounts Clerk, Typist</li></ul><h3>Application Details</h3><ul><li><strong>Start Date:</strong> February 1, 2025</li><li><strong>Last Date:</strong> March 15, 2025</li><li><strong>Application Fee:</strong> ₹500 (General), ₹250 (SC/ST/Women)</li></ul><h3>Selection Process</h3><ol><li>Computer Based Test (CBT) - 1st Stage</li><li>Computer Based Test (CBT) - 2nd Stage</li><li>Typing/Skill Test (as applicable)</li><li>Document Verification</li><li>Medical Examination</li></ol><p>Candidates are advised to apply early and avoid last-minute rush. Ensure all documents are ready before starting the application.</p>',
                'category' => 'Jobs',
                'publish_date' => '2025-02-01',
            ],
            [
                'title' => 'National Education Policy 2025 Updates – Major Changes',
                'short_description' => 'The Ministry of Education has announced major updates to the National Education Policy. Read about the new changes affecting students nationwide.',
                'content' => '<h2>NEP 2025 Major Updates</h2><p>The Ministry of Education, Government of India, has announced significant updates and amendments to the National Education Policy (NEP). These changes are set to transform the Indian education landscape.</p><h3>Key Changes</h3><ul><li><strong>4-Year Undergraduate Program:</strong> Now mandatory across all central universities</li><li><strong>Multiple Entry/Exit:</strong> Students can exit at any year with appropriate certification</li><li><strong>Academic Bank of Credits:</strong> Fully operational across 500+ universities</li><li><strong>Mother Tongue Instruction:</strong> Extended support in 12 regional languages</li></ul><h3>Impact on Students</h3><p>These changes will directly impact millions of students across India. The flexibility in education pathways is expected to reduce dropout rates significantly.</p><h3>Implementation Timeline</h3><ul><li>Phase 1 (2025): Central Universities</li><li>Phase 2 (2026): State Universities</li><li>Phase 3 (2027): Private Universities</li></ul><p>Educational experts have largely welcomed these changes, calling them progressive and student-centric reforms that align with global education standards.</p>',
                'category' => 'News',
                'publish_date' => '2025-03-10',
            ],
            [
                'title' => 'JEE Advanced 2025 Admit Card – Download Link Active',
                'short_description' => 'IIT Delhi has activated the JEE Advanced 2025 admit card download link. Qualified JEE Main candidates can download their hall tickets now.',
                'content' => '<h2>JEE Advanced 2025 Admit Card</h2><p>The Indian Institute of Technology (IIT) Delhi, the organizing institute for JEE Advanced 2025, has activated the admit card download link. Only candidates who qualified JEE Main 2025 with the top 2,50,000 ranks are eligible.</p><h3>Download Details</h3><ul><li><strong>Download Start Date:</strong> May 20, 2025</li><li><strong>Exam Date:</strong> June 1, 2025</li><li><strong>Official Website:</strong> jeeadv.ac.in</li></ul><h3>Exam Centers</h3><p>The exam will be conducted across 200+ cities in India and in select international centers. Candidates should check their allotted center carefully.</p><h3>What to Carry</h3><ul><li>Printed Admit Card</li><li>Valid Photo ID (Aadhaar/Passport)</li><li>Passport-size photographs</li><li>PwD certificate (if applicable)</li></ul><p>The exam will be conducted in two papers of 3 hours each. Paper 1 is from 9 AM to 12 PM and Paper 2 is from 2:30 PM to 5:30 PM.</p>',
                'category' => 'Admit Card',
                'publish_date' => '2025-05-15',
            ],
            [
                'title' => 'NEET UG 2025 Result – Scorecard Available for Download',
                'short_description' => 'NTA has released the NEET UG 2025 results. Students can download their scorecards and check cutoff marks for medical admissions.',
                'content' => '<h2>NEET UG 2025 Result Declared</h2><p>The National Testing Agency (NTA) has declared the results of the National Eligibility cum Entrance Test (NEET) UG 2025. Over 20 lakh students who appeared for the examination can now check their results.</p><h3>Result Statistics</h3><ul><li><strong>Total Registered:</strong> 24,50,000</li><li><strong>Total Appeared:</strong> 22,80,000</li><li><strong>Total Qualified:</strong> 12,50,000 (approx)</li><li><strong>General Cutoff:</strong> 720-138 marks</li></ul><h3>Counselling Schedule</h3><p>The All India Quota (AIQ) counselling will be conducted by the Medical Counselling Committee (MCC). State quota counselling will be handled by respective state authorities.</p><h3>Important Dates</h3><ul><li>AIQ Counselling Round 1: July 15-25, 2025</li><li>AIQ Counselling Round 2: August 5-15, 2025</li><li>State Counselling: August onwards</li></ul>',
                'category' => 'Results',
                'publish_date' => '2025-06-14',
            ],
            [
                'title' => 'SBI Clerk 2025 Recruitment – 13,000 Vacancies Open',
                'short_description' => 'State Bank of India has opened applications for SBI Clerk 2025 with 13,000+ vacancies across India. Last date to apply is approaching.',
                'content' => '<h2>SBI Clerk 2025 Recruitment Drive</h2><p>The State Bank of India (SBI) has launched a major recruitment drive for Junior Associate (Clerk) positions with over 13,000 vacancies across all states and union territories.</p><h3>Vacancy Breakdown by Region</h3><ul><li><strong>North Zone:</strong> 3,200 vacancies</li><li><strong>South Zone:</strong> 2,800 vacancies</li><li><strong>East Zone:</strong> 2,500 vacancies</li><li><strong>West Zone:</strong> 2,300 vacancies</li><li><strong>Central Zone:</strong> 2,200 vacancies</li></ul><h3>Salary & Benefits</h3><ul><li>Basic Pay: ₹19,900 - ₹47,920</li><li>DA, HRA, CCA as applicable</li><li>Pension/NPS benefits</li><li>Medical insurance for family</li></ul><h3>Eligibility</h3><p>Graduates from any recognized university aged between 20-28 years can apply. Age relaxation applicable as per government rules for reserved categories.</p>',
                'category' => 'Jobs',
                'publish_date' => '2025-04-01',
            ],
            [
                'title' => 'GATE 2025 Exam Analysis – Paper-wise Difficulty Level',
                'short_description' => 'Complete analysis of GATE 2025 examination across all papers. Check difficulty level, expected cutoffs, and important topics asked.',
                'content' => '<h2>GATE 2025 Comprehensive Exam Analysis</h2><p>The Graduate Aptitude Test in Engineering (GATE) 2025 was conducted successfully across multiple sessions. Here is a detailed paper-wise analysis covering difficulty levels, important topics, and expected cutoffs.</p><h3>Computer Science (CS)</h3><ul><li><strong>Difficulty:</strong> Moderate to Difficult</li><li><strong>Key Topics:</strong> Data Structures, Algorithms, DBMS, OS</li><li><strong>Expected Cutoff:</strong> 28-30 marks</li></ul><h3>Electronics (ECE)</h3><ul><li><strong>Difficulty:</strong> Moderate</li><li><strong>Key Topics:</strong> Signals & Systems, Analog Circuits, Digital Electronics</li><li><strong>Expected Cutoff:</strong> 25-27 marks</li></ul><h3>Mechanical (ME)</h3><ul><li><strong>Difficulty:</strong> Easy to Moderate</li><li><strong>Key Topics:</strong> Thermodynamics, Fluid Mechanics, Manufacturing</li><li><strong>Expected Cutoff:</strong> 30-33 marks</li></ul><p>Results are expected to be declared by March 15, 2025. Qualified candidates can apply for PSU recruitments and M.Tech admissions at IITs and NITs.</p>',
                'category' => 'Exams',
                'publish_date' => '2025-02-08',
            ],
            [
                'title' => 'Union Budget 2025 – Key Highlights for Education Sector',
                'short_description' => 'Finance Minister presented Union Budget 2025 with major allocations for education, scholarships, and skill development programs.',
                'content' => '<h2>Union Budget 2025 – Education Sector Highlights</h2><p>The Finance Minister presented the Union Budget 2025-26 with significant focus on education and skill development. The total allocation for the education sector has been increased by 15% compared to the previous year.</p><h3>Key Announcements</h3><ul><li><strong>Education Budget:</strong> ₹1,25,000 Crore (15% increase)</li><li><strong>New IITs:</strong> 3 new IITs announced</li><li><strong>Scholarship Fund:</strong> ₹5,000 Crore for merit scholarships</li><li><strong>Digital Education:</strong> ₹3,000 Crore for e-learning platforms</li></ul><h3>Skill Development</h3><ul><li>50 new Skill India Centers across Tier-2 cities</li><li>Free certification courses for 10 lakh youth</li><li>Industry partnership programs with 200+ companies</li></ul><h3>Research & Innovation</h3><p>A new National Research Foundation with ₹10,000 Crore corpus has been announced to boost research in Indian universities and academic institutions.</p><p>Education experts have welcomed these announcements, stating that they will significantly boost the quality of education in India.</p>',
                'category' => 'News',
                'publish_date' => '2025-02-01',
            ],
        ];

        foreach ($blogs as $blogData) {
            $category = Category::where('name', $blogData['category'])->first();

            Blog::firstOrCreate(
                ['slug' => Str::slug($blogData['title'])],
                [
                    'title' => $blogData['title'],
                    'short_description' => $blogData['short_description'],
                    'content' => $blogData['content'],
                    'image' => null,
                    'category_id' => $category->id,
                    'publish_date' => $blogData['publish_date'],
                ]
            );
        }
    }
}
