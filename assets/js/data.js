/* All site content lives here; list, single and search pages read from it. */
window.KEELSON = {
  services: [
    { slug: "coastal-and-port-design", title: "Coastal and port design",
      short: "Quay walls, breakwaters, seawalls and berths, designed for the water levels of 2100.",
      intro: [
        "We design the hard edge of the coast: quay walls, jetties, breakwaters, revetments and seawalls. Every scheme starts from a wave and water-level model built for the site, not from a standard section.",
        "Our designers work next to the modellers and surveyors who supply their inputs, so a change in design wave height reaches the drawings the same day.",
        "We design for adaptation. Where sea level rise will outrun a structure's life, we show the owner what a later raise or retrofit costs before anyone builds the first phase."],
      deliver: ["Wave and water-level assessment", "Concept and detailed design", "Construction drawings and specification", "Design support during construction"],
      time: "Concept in 6 to 10 weeks; detailed design in 4 to 8 months" },
    { slug: "survey-and-dredging", title: "Survey and dredging",
      short: "Bathymetric surveys, dredge design and post-dredge verification from our own vessels.",
      intro: [
        "Our two survey vessels carry multibeam sonar, sub-bottom profilers and side-scan. We survey harbours, channels, outfalls and pipeline routes down to 2 cm vertical accuracy.",
        "For dredging we design the channel, estimate volumes, and write the specification. After the dredger leaves, we resurvey and certify what was actually removed.",
        "We resurvey before a scheme is priced. Seabeds move, and a six-month-old survey is often wrong by enough to change the bid."],
      deliver: ["Multibeam and side-scan survey", "Dredge design and volume estimates", "Contractor specification and tender support", "Post-dredge verification survey"],
      time: "Survey mobilised in 2 weeks; most harbours surveyed in 3 to 10 days" },
    { slug: "structure-inspection", title: "Structure inspection",
      short: "Diver and ROV inspection of piles, quay walls and outfalls, with a repair priority list.",
      intro: [
        "Steel corrodes fastest at the splash zone and at the mudline, and both are hard to see. Our inspection team combines diver, ROV and above-water methods to reach both.",
        "Every inspection ends in a ranked repair list: what must be fixed this year, what can wait, and what to watch. Owners get numbers they can put into a budget.",
        "We record every defect against a 3D model of the structure, so the next inspection compares like with like."],
      deliver: ["Diver and ROV inspection", "Thickness and cathodic protection readings", "Condition report with photographs", "Ranked repair and budget plan"],
      time: "Typical programme: 2 to 6 weeks on site, report 3 weeks after" },
    { slug: "flood-and-sea-level-risk", title: "Flood and sea-level risk",
      short: "Flood modelling and adaptation pathways for ports, utilities and coastal towns.",
      intro: [
        "We model how storm surge, waves, rivers and rising seas combine at a specific site, and what each combination costs when it arrives.",
        "The output is a set of adaptation pathways: which action to take now, which to trigger later, and the sea level that should trigger it.",
        "Boards use our reports to set capital plans. Councils use them to defend planning decisions."],
      deliver: ["Hydrodynamic flood modelling", "Damage and downtime estimates", "Adaptation pathway report", "Public and board presentations"],
      time: "Screening in 4 weeks; full risk study in 3 to 5 months" },
    { slug: "environmental-permitting", title: "Environmental permitting",
      short: "Marine licences, habitat surveys and consent strategy that keep projects moving.",
      intro: [
        "Marine works need licences, and licences need evidence. We run the habitat, water quality and noise studies and write the application.",
        "We treat consent constraints as design inputs. A dredge window set by a fish spawning season is planned in from week one, so it never becomes a delay.",
        "Our team has handled applications with regulators in the UK, the Netherlands and Norway."],
      deliver: ["Environmental baseline surveys", "Impact assessment", "Marine licence applications", "Monitoring during construction"],
      time: "Simple licences in 3 months; full impact assessments in 9 to 14 months" },
    { slug: "project-delivery", title: "Project delivery",
      short: "Owner's engineer and site supervision from tender through handover.",
      intro: [
        "We act as the owner's engineer: writing the tender, comparing bids, supervising the works and certifying completion.",
        "Our site engineers live near the work, and each writes a weekly report that a non-engineer can read.",
        "Handover is a phase of its own. We deliver as-built models, maintenance plans and an inspection schedule, so the asset can be run without us."],
      deliver: ["Tender documents and bid evaluation", "Site supervision", "Cost and programme control", "As-built records and handover"],
      time: "Engaged for the length of the project, typically 12 to 30 months" }
  ],

  team: [
    { slug: "ines-varga", img: "1438761681033-6461ffad8d80", name: "Ines Varga", role: "Managing director", bio: "Coastal engineer. Designed her first quay wall in 2004 and still reviews every scheme's design basis." },
    { slug: "tomas-reyes", img: "1507003211169-0a1dd7228f2d", name: "Tomas Reyes", role: "Head of survey", bio: "Hydrographer who runs both survey vessels and the data team behind them." },
    { slug: "amara-okafor", img: "1573497019940-1c28c88b4f3e", name: "Amara Okafor", role: "Principal, marine structures", bio: "Specialist in steel and concrete port structures and how they age in salt water." },
    { slug: "daniel-whitcombe", img: "1472099645785-5658abf4ff4e", name: "Daniel Whitcombe", role: "Principal, flood risk", bio: "Builds the flood models that councils and port boards use to plan for sea level rise." },
    { slug: "priya-raman", img: "1580489944761-15a19d654956", name: "Priya Raman", role: "Environmental lead", bio: "Marine ecologist who has taken more than sixty marine licences through consent." },
    { slug: "lukas-bergstrom", img: "1500648767791-00dcc994a43e", name: "Lukas Bergström", role: "Delivery director", bio: "Runs site teams and owner's engineer roles. Believes handover starts on day one." },
    { slug: "sofia-marchetti", img: "1544005313-94ddf0286df2", name: "Sofia Marchetti", role: "Senior hydrodynamic modeller", bio: "Models waves, currents and scour, and explains the results without jargon." },
    { slug: "kwame-asante", img: "1621905251189-08b45d6a269e", name: "Kwame Asante", role: "Inspection lead", bio: "Commercial diver turned engineer. Leads the diver and ROV inspection team." }
  ],

  posts: [
    { slug: "designing-seawalls-for-the-fifty-year-storm", img: "1505118380757-91f5f5632de0", title: "Designing seawalls for the fifty-year storm, not the last one",
      cat: "Coastal design", date: "2026-09-08", author: "ines-varga", read: 6,
      excerpt: "Records tell us what the sea did. Design has to allow for what it will do. Here is how we choose a design storm when the past is a poor guide.",
      body: [
        "Most seawalls are designed against a storm from the record: the worst surge in the last fifty or a hundred years. That number is honest, but it describes a sea that no longer exists.",
        "## Start from the life of the asset",
        "A wall built in 2026 will still be standing in 2076. We take the sea level projected for the end of that life, add the storm surge, then add wave setup and run-up. The result is usually 0.6 to 1.1 m higher than a design based on the record.",
        "## Then price the option to raise it later",
        "Building the full height on day one is not always right. Sometimes a wall with a stronger foundation, designed to be raised in thirty years, costs 20 percent less now and the same later. We show clients both, with the trigger level that tells them when to act.",
        "The point is to make the decision visible. An owner who chooses to defer knowingly is in a very different position from one who never saw the choice."] },
    { slug: "why-we-resurvey-before-we-dredge", img: "1504307651254-35680f356dfd", title: "Why we resurvey before we dredge",
      cat: "Survey", date: "2026-08-19", author: "tomas-reyes", read: 4,
      excerpt: "A survey that is six months old can be wrong by tens of thousands of cubic metres. A two-day resurvey costs far less than an error in the bid.",
      body: [
        "Channels silt up unevenly. After a winter of storms, one bend can lose a metre of depth while the straight beside it is unchanged.",
        "## What the old survey misses",
        "On a recent channel project the six-month-old survey predicted 84,000 cubic metres of dredging. The resurvey found 112,000. The difference was a shoal that had built up behind a breakwater after two autumn storms.",
        "## The cost of asking again",
        "Two days of vessel time cost less than one percent of the dredging contract. Contractors bid the risk they cannot see, and they price it high. A fresh survey removes it from the bid."] },
    { slug: "reading-a-corroded-pile", img: "1544551763-46a013bb70d5", title: "How to read a corroded pile",
      cat: "Inspection", date: "2026-07-30", author: "kwame-asante", read: 5,
      excerpt: "Two piles can lose the same steel and need very different action. What a diver looks for, and what the numbers mean for a repair budget.",
      body: [
        "Thickness readings are only half of an inspection. Where the steel has been lost matters as much as how much.",
        "## Splash zone and mudline",
        "Steel corrodes fastest where it is wet and dry in turn, and again at the mudline where oxygen and bacteria meet. A pile that has lost 30 percent at the splash zone is a repair job. The same loss at mid-depth is usually a monitoring job.",
        "## From readings to a budget",
        "We rank every pile against its remaining capacity and its position in the structure. A corner pile carrying a crane rail comes before a lightly loaded pile in the middle. The result is a repair list an owner can spread over five years."] },
    { slug: "permits-are-a-design-input", img: "1541888946425-d81bb19240f5", title: "Permits are a design input, not a hurdle",
      cat: "Permitting", date: "2026-06-24", author: "priya-raman", read: 4,
      excerpt: "Consent conditions shape a marine project as much as soil or tide. Treat them as design inputs and the programme stops slipping.",
      body: [
        "A dredge window that closes in March because of spawning fish is as firm as any structural limit. Teams that discover it late lose a season.",
        "## Bring the ecologist in at concept",
        "In the first design workshop we list every seasonal, noise and turbidity limit. The programme is then built around them, not squeezed between them.",
        "## Talk to the regulator early",
        "An informal meeting before the application is filed usually saves months. Regulators would rather shape a scheme than reject one, and they tell you what evidence they will need."] },
    { slug: "what-a-sea-level-range-means-for-a-budget", img: "1583417319070-4a69db38a482", title: "What a sea-level range means for a budget",
      cat: "Risk", date: "2026-05-13", author: "daniel-whitcombe", read: 5,
      excerpt: "Projections come as ranges, and boards need a number. How we turn a range into a decision without pretending it is a single figure.",
      body: [
        "Sea level projections for 2100 run from about 0.4 m to well over 1 m, depending on emissions and ice behaviour. A capital plan cannot use a range directly.",
        "## Use thresholds, not dates",
        "We stop asking when the sea will reach a level and ask what happens at each level. At 0.3 m the berth floods once a year. At 0.6 m it floods monthly. Each threshold has a cost and a response.",
        "## Monitor and trigger",
        "The board agrees now what it will do at each threshold, and the monitoring tells it which one is approaching. Spending follows the evidence."] },
    { slug: "handover-is-a-phase", img: "1520607162513-77705c0f0d4a", title: "Handover is a phase, not a day",
      cat: "Delivery", date: "2026-04-02", author: "lukas-bergstrom", read: 4,
      excerpt: "Most projects finish with a box of drawings. We plan the handover from the first week so the owner can run the asset without us.",
      body: [
        "The day a project is handed over is when the people who understood it start leaving. The paper they leave behind is often the only memory it has.",
        "## Records built as you go",
        "We keep the as-built model current during construction, not after. Every change order updates it, so at practical completion it is already correct.",
        "## A maintenance plan the owner wrote with us",
        "We run a short workshop with the operators before handover and write the inspection schedule with them. The people who will use it have read it before they need it."] }
  ],


  faqs: [
    { group: "Working with us", q: "What kind of clients do you work with?", a: "Port authorities, terminal operators, local councils, utilities and contractors. If your asset is where land meets water, we probably know it." },
    { group: "Working with us", q: "Do you work outside the UK?", a: "Yes. About a third of our work is in the Netherlands, Germany and Norway. Our survey vessels can be shipped or we hire local vessels." },
    { group: "Working with us", q: "How quickly can you start?", a: "Surveys can mobilise in two weeks. Design and advisory work usually starts within a month of a signed agreement." },
    { group: "Surveys and inspections", q: "How accurate are your surveys?", a: "Multibeam surveys reach 2 cm vertical accuracy in good conditions. Every report states the accuracy achieved, not just the target." },
    { group: "Surveys and inspections", q: "Do you inspect underwater without divers?", a: "Yes. We use ROVs where visibility and access allow, and divers where we need to touch and measure the steel. Many jobs use both." },
    { group: "Surveys and inspections", q: "How often should a quay wall be inspected?", a: "Every one to two years for a visual check, and a full underwater inspection every five years. Older or heavily loaded structures need it sooner." },
    { group: "Fees and delivery", q: "How do you charge?", a: "Fixed fees for defined work such as surveys and reports. Time-and-materials with a cap for design work that is still being scoped. We give the cap up front." },
    { group: "Fees and delivery", q: "Will you help us write a tender?", a: "Yes. Writing the tender and comparing bids is part of our owner's engineer service, and we can do it on its own." },
    { group: "Fees and delivery", q: "What do we receive at the end?", a: "A report or design package, the source data and, for construction projects, an as-built model and a maintenance plan. You own everything we produce." }
  ]
};
