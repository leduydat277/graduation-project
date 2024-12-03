import currency from "currency.js";

export const formatPrice = (value?: number, config: any = {}) => {
    if (!Number.isInteger(value)) return "";
    return currency(value as any, {
      pattern: `# !`,
      separator: ",",
      precision: 0,
      symbol: "đ",
      ...config,
    }).format();
  };