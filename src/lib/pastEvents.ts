export const EVENTS_PER_PAGE = 5;

export interface PastEvent {
  title: string;
  date: string;
  description: string;
  image: string;
  imageAlt: string;
  moreUrl?: string;
}

/** Všechny proběhlé akce – lze rozšířit */
export const allPastEvents: PastEvent[] = [
  {
    title: 'Den Lidských práv',
    date: '10. PROSINCE 2025, 12:00',
    description: 'Katedra historie ve spolupráci s Krajskou vědeckou knihovnou v Liberci, Memoriae Loci a Libereckým krajem pořádala již čtvrtý ročník Dne lidských práv.',
    image: '/images/den-lidskych-prav.webp',
    imageAlt: 'Detail rezavého ostnatého drátu v popředí s rozmazaným pozadím.',
    moreUrl: 'https://khi.fp.tul.cz/cinnost/prednasky-pro-verejnost/385-lidprava',
  },
  // Další akce přidávejte sem – na každé stránce se zobrazí 5
];

export function getPastEventsForPage(page: number): {
  events: PastEvent[];
  totalPages: number;
  currentPage: number;
  total: number;
} {
  const total = allPastEvents.length;
  const totalPages = Math.max(1, Math.ceil(total / EVENTS_PER_PAGE));
  const currentPage = Math.max(1, Math.min(page, totalPages));
  const start = (currentPage - 1) * EVENTS_PER_PAGE;
  const events = allPastEvents.slice(start, start + EVENTS_PER_PAGE);
  return { events, totalPages, currentPage, total };
}
