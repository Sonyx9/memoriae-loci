import type { Project } from './types';

export const projects: Project[] = [
  {
    slug: 'kameny-zmizelych',
    name: 'Kameny zmizelých',
    description: 'Jedním z klíčových center pohraničí bylo město Liberec, které před okupací nacionálně socialistickým Německem patřilo mezi nejvýznamnější centra českých Němců.',
    heroImage: '/images/kameny-zmizelych.webp',
    heroImageAlt: 'Auschwitz – vstupní brána s nápisem ‚Arbeit macht frei‘',
    heroImageTitle: 'Auschwitz – vstupní brána s nápisem ‚Arbeit macht frei‘',
    heroImageDescription: 'Historická fotografie vstupní brány bývalého koncentračního tábora Auschwitz s nápisem ‚Arbeit macht frei‘, symbolu nacistické perzekuce a genocidy.',
    longDescription: 'Jedním z klíčových center pohraničí bylo město Liberec, které před okupací nacionálně socialistickým Německem patřilo mezi nejvýznamnější centra českých Němců.',
    externalUrl: 'https://stolpersteine.memoriaeloci.cz/',
    subtitle: 'Kameny zmizelých',
  },
  {
    slug: 'pribehy-mest',
    name: 'Ve jménu Lilie',
    description: 'Odhalte, jak se skauting v Liberci vyvíjel a jaké klíčové momenty ho formovaly.',
    heroImage: '/images/denik-tabor-1973.webp',
    longDescription: 'Odhalte, jak se skauting v Liberci vyvíjel a jaké klíčové momenty ho formovaly.',
    subtitle: 'Příběh libereckých skautů',
    externalUrl: '/ve-jmenu-lilie',
  },
  {
    slug: 'liberecke-pribehy',
    name: 'Liberecké příběhy',
    description: 'Magazín o historii, lidech a místech v Liberci a okolí.',
    heroImage: '/images/liberecke-pribehy.webp',
    heroImageAlt: 'Muž v tradičním oblečení stojí s kytarou před horskou krajinou, v pozadí viditelné hory a les',
    heroImageTitle: 'Muž s kytarou v horách',
    heroImageDescription: 'Černobílá fotografie muže v tradičním oblečení, který drží kytaru. Stojí před malebnou horskou krajinou s lesem a horami v pozadí, což vytváří nostalgickou atmosféru.',
    heroImagePosition: '50% 2%',
    longDescription: 'Magazín zaměřený na dokumentaci příběhů, historie a lidí spojených s Libercem a jeho okolím. Přinášíme články o významných událostech, osobnostech a místech, která formovala historii regionu.',
    subtitle: 'Magazín',
  },
  {
    slug: 'zapomenuta-mista-liberec',
    name: 'Zapomenutá místa',
    description: 'Dokumentace míst, která postupně mizí z naší paměti.',
    heroImage: '/images/zapomenuta-mista.webp',
    heroImageAlt: 'Nápis ‚Mír národům celého světa‘ na fasádě domu v centru Liberec.',
    heroImageTitle: 'Mír národům celého světa – historický nápis v Liberci',
    heroImageDescription: 'Detail historického nápisu ‚Mír národům celého světa‘ na budově v Liberci, připomínající ideologii a veřejný prostor druhé poloviny 20. století.',
    longDescription: 'Projekt zaměřený na dokumentaci míst, která mají historický význam, ale postupně se vytrácejí z kolektivní paměti. Snažíme se zachytit jejich příběhy dříve, než zmizí navždy.',
    subtitle: 'Skrytá tajemství',
  },
];

export function getProjectBySlug(slug: string): Project | undefined {
  return projects.find(p => p.slug === slug);
}
