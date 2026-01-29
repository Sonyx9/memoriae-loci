import { visit } from 'unist-util-visit';

const REMOVE_HEADINGS = new Set(['Úvod', 'Hlavní část', 'Závěr']);
const REMOVE_TEXT_PATTERN = /^Tento článek je součástí projektu/;

function getText(node: { type: string; value?: string; children?: unknown[] }): string {
  if (node.type === 'text' && node.value != null) return node.value;
  if ('children' in node && Array.isArray(node.children)) {
    return (node.children as { type: string; value?: string; children?: unknown[] }[]).map((c) => getText(c)).join('');
  }
  return '';
}

function trimText(s: string): string {
  return s.replace(/\s+/g, ' ').trim();
}

/** Removes h1 headings whose text is exactly "Úvod", "Hlavní část", or "Závěr", all hr (horizontal rule) elements, and paragraphs starting with "Tento článek je součástí projektu". */
export function rehypeRemoveSectionHeadings() {
  return (tree: unknown) => {
    const toRemove: { parent: { children: unknown[] }; index: number }[] = [];
    visit(tree as import('unist').Node, 'element', (node, index, parent) => {
      const el = node as { tagName: string; type: string; children?: unknown[] };
      if (parent && typeof index === 'number') {
        // Odstranit nadpisy Úvod, Hlavní část, Závěr
        if (el.tagName === 'h1') {
          const text = trimText(getText(el));
          if (REMOVE_HEADINGS.has(text)) {
            toRemove.push({ parent: parent as { children: unknown[] }, index });
          }
        }
        // Odstranit všechny hr elementy (oddělovače)
        if (el.tagName === 'hr') {
          toRemove.push({ parent: parent as { children: unknown[] }, index });
        }
        // Odstranit odstavce začínající "Tento článek je součástí projektu"
        if (el.tagName === 'p' || el.tagName === 'em') {
          const text = trimText(getText(el));
          if (REMOVE_TEXT_PATTERN.test(text)) {
            toRemove.push({ parent: parent as { children: unknown[] }, index });
          }
        }
      }
    });
    toRemove.reverse().forEach(({ parent, index }) => {
      parent.children.splice(index, 1);
    });
  };
}
