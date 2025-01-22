const AccordionItem = ({ children }: { children: React.ReactNode }) => {
  return (
    <li className="w-full bg-white rounded border border-subtle">{children}</li>
  );
};

export default AccordionItem;
