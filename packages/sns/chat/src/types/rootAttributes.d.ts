export type RootAttributes = {
  userAvatar: string;
  faqs: Faqs;
  pageTitle: string;
  firstAnswer: string;
};

export type Faqs = {
  title?: string;
  questions?: Questions[];
};

export type Questions = {
  id?: string;
  heading: string;
  items?: Question[];
};

export type Question = {
  id?: string;
  title?: string;
};
